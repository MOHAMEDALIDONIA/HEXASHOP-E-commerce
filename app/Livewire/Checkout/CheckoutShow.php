<?php

namespace App\Livewire\Checkout;

use App\Events\OrderEvent;
use App\Livewire\Admin\Order\ShowOrders;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\services\MyFatoorah;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;



class CheckoutShow extends Component
{   

   
    #[Validate]
    public $carts ,$totalprice =0 ,$orderitem,$user,$discount_percentage ;
    public $fullname,$phone,$email,$address,$pin_code,$delivery_date,$location_type,$delivery_instructions,$prefer_delivery_time;
    
    protected $rules = [
        'fullname' => 'required|string|max:60|regex:/^[a-zA-Z].*/',
         'phone'=>'required|numeric|min:10',
         'email'=>'email|required|max:121',
         'address'=>'required|string|max:600',
         'pin_code'=>'required|max:6|min:6',
         'location_type'=>'required',
         'delivery_date'=>'required|date|after:today|before:14 days',
         'prefer_delivery_time'=>'required',
    
         
    ];
    protected $messages = [
        'fullname.regex' => 'The fullname field must be start by character',
    ];

    public function save(){
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        if($this->carts->count() == 0){
            session()->flash('message','you must add items in cart to checkout');
            return false;
        }
        $this->validate();
      
        $order = Order::create([
            'user_id'=>auth()->user()->id,
            'tracking_no'=>'Mo-Do-'.random_int(10000,20000),
            'fullname'=>$this->fullname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'pincode'=>$this->pin_code,
            'address'=>$this->address,
            'status_message'=>'in progress',
            'delivery_date'=>$this->delivery_date,
            'payment_mode'=>'Cash ON Delivery',
            'location_type'=>$this->location_type,
            'prefer_delivary_time'=>$this->prefer_delivery_time,
            'delivary_instructions'=>$this->delivery_instructions
        ]);
      
        
     
       foreach ($this->carts as $cartitem) {
         if($cartitem->product->discount_price !== Null){
            $orderitem = OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$cartitem->product_id,
                'product_color_id'=>$cartitem->product_color_id,
                'quantity'=>$cartitem->quantity,
                'price'=>$cartitem->product->selling_price - $cartitem->product->discount_price
            ]);
         }else{
            $orderitem = OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$cartitem->product_id,
                'product_color_id'=>$cartitem->product_color_id,
                'quantity'=>$cartitem->quantity,
                'price'=>$cartitem->product->selling_price,
            ]);
         }
         if($cartitem->product_color_id != NULL){
            $cartitem->productColor()->where('id',$cartitem->product_color_id)->decrement('quantity',$cartitem->quantity);
            $cartitem->product()->where('id',$cartitem->product_id)->decrement('quantity',$cartitem->quantity);
            if($cartitem->productColor()->where('id',$cartitem->product_color_id)->first()->quantity == 0){
              $cartitem->productColor()->where('id',$cartitem->product_color_id)->delete();
            }
           }else{
              $cartitem->product()->where('id',$cartitem->product_id)->decrement('quantity',$cartitem->quantity);
              if( $cartitem->product()->where('id',$cartitem->product_id)->first()->quantity == 0){
                  $cartitem->product()->where('id',$cartitem->product_id)->update([
                      'status'=>1
                  ]);
                 }
        }
       }
 
        if(Cart::where('user_id',auth()->user()->id)->count() > 0){ 
            Cart::where('user_id',auth()->user()->id)->delete();
            $todaydate = Carbon::now()->format('Y-m-d');
            $order = Order:: whereDate('created_at',$todaydate)->latest()->first();
            if ($order->users && $order->users->DiscountCode) {
                         
                $data = [
                    'id'=>$order->id,
                    'user_id'=>$order->user_id,
                    'tracking_no'=>$order->tracking_no,
                    'fullname'=>$order->fullname,
                    'status_message'=>'in progress',
                    'delivery_date'=>$order->delivery_date,
                    'payment_mode'=>'Cash ON Delivery',
                    'location_type'=>$order->location_type,
                    'created_at'=>$order->created_at->format('Y-m-d'),
                    'discount_code'=>$order->users->DiscountCode->discount_code.'//Percentage(%'.$order->users->DiscountCode->discount_percentage.')'
                ];
            } else {
                $data = [
                    'id'=>$order->id,
                    'user_id'=>$order->user_id,
                    'tracking_no'=>$order->tracking_no,
                    'fullname'=>$order->fullname,
                    'status_message'=>'in progress',
                    'delivery_date'=>$order->delivery_date,
                    'payment_mode'=>'Cash ON Delivery',
                    'created_at'=>$order->created_at->format('Y-m-d'),
                    'location_type'=>$order->location_type,
                    'discount_code'=>'__'
                ];
            }
   
            broadcast(new OrderEvent($data));
            return redirect()->to('thank-you');

          }else{
            session()->flash('message','Something Went Wrong');
          }
     
        
       
    }

    public function TotalProductPrice(){
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        $this->user =User::where('id',auth()->user()->id)->first();
        $this->totalprice =0;
        foreach ($this->carts as  $cartitem) {
            if ($cartitem->product->discount_price !== null) {
                $this->totalprice += ($cartitem->product->selling_price - $cartitem->product->discount_price)*$cartitem->quantity;
            } else {
                $this->totalprice += $cartitem->product->selling_price *$cartitem->quantity;
            }
           
        
            
        }
    
        if ($this->user->DiscountCode()->where('user_id',auth()->user()->id)->exists()) {
            $discount_user = $this->user->DiscountCode()->where('user_id',auth()->user()->id)->first();
              $this->discount_percentage = $discount_user->discount_percentage;
             $this->totalprice = $this->totalprice - ($this->totalprice*($this->discount_percentage/100));
            
              
         }
        return $this->totalprice;
    }

    public function render()
    {    
       $this->carts = Cart::where('user_id',auth()->user()->id)->get();
       $this->fullname = auth()->user()->name;
       $this->email = auth()->user()->email;
       $this->user =User::where('id',auth()->user()->id)->first();
       $this->totalprice = $this->TotalProductPrice();
       $this->orderitem = $this->carts->sum('quantity');
        return view('livewire.checkout.checkout-show',[
            'totalprice'=>$this->totalprice
        ]);
    }
}
