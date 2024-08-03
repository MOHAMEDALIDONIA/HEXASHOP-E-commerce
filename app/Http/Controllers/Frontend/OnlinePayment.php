<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;
use App\services\MyFatoorah;


class OnlinePayment extends Controller
{
    private $fatoorasevices;
    public $OrderData =[],$pin_code;
    public function __construct(MyFatoorah $fatoorasevices)
    {
        $this->fatoorasevices = $fatoorasevices;
    }
    public function TotalProductPrice(){
        $carts = Cart::where('user_id',auth()->user()->id)->get();
        $user =User::where('id',auth()->user()->id)->first();
        $totalprice =0;
        foreach ($carts as  $cartitem) {
            if ($cartitem->product->discount_price !== null) {
                $totalprice += ($cartitem->product->selling_price - $cartitem->product->discount_price)*$cartitem->quantity;
            } else {
                $totalprice += $cartitem->product->selling_price *$cartitem->quantity;
            }
           
        
            
        }
    
        if ($user->DiscountCode()->where('user_id',auth()->user()->id)->exists()) {
            $discount_user = $user->DiscountCode()->where('user_id',auth()->user()->id)->first();
              $discount_percentage = $discount_user->discount_percentage;
             $totalprice = $totalprice - ($totalprice*($discount_percentage/100));
            
              
         }
        return $totalprice;
    }
    public function savedata(...$pin){
        $this->pin_code =$pin;
        return $this->pin_code;
        // $vaildateData=$request->validate([
         
        //     'address'=>'required|string|max:600',
        //     'pin_code'=>'required|max:6|min:6',
        //     'location_type'=>'required',
        //     'delivery_date'=>'required|date|after:today|before:14 days',
        //     'prefer_delivery_time'=>'required',
        //     'delivery_instructions'=>'nullable'
        //   ]);
        //   $this->OrderData['pin_code'] = $vaildateData['pin_code'];
        //   $this->OrderData['address'] = $vaildateData['address'];
        //   $this->OrderData['delivery_date'] = $vaildateData['delivery_date'];
        //   $this->OrderData['location_type'] = $vaildateData['location_type'];
        //   $this->OrderData['prefer_delivery_time'] = $vaildateData['prefer_delivery_time'];   
        //   $this->OrderData['delivery_instructions'] = $vaildateData['delivery_instructions']; 
        //   return $this->OrderData;
    }
    public function PaymentFormView() {
        $carts = Cart::where('user_id',auth()->user()->id)->get();
        $orderitem = $carts->sum('quantity');
        $totalprice = $this->TotalProductPrice();
        $user =User::where('id',auth()->user()->id)->first();
        return view('frontend.pages.paymentform',compact('orderitem','totalprice','user'));
    }
    public function PayOrder(Request $request){
        $carts = Cart::where('user_id',auth()->user()->id)->get();
        if($carts->count() == 0){
            session()->flash('message','you must add items in cart to checkout');
            return false;
        }
      $vaildateData=$request->validate([
        'fullname' => 'required|string|max:60|regex:/^[a-zA-Z].*/',
        'phone'=>'required|numeric|min:10',
        'email'=>'email|required|max:121',
        'address'=>'required|string|max:600',
        'pin_code'=>'required|max:6|min:6',
        'location_type'=>'required',
        'delivery_date'=>'required|date|after:today|before:14 days',
        'prefer_delivery_time'=>'required',
        'language'=>'required',
        'mobile_country_code'=>'required',
        'currency_iso_code'=>'required',
        'delivery_instructions'=>'nullable'
      ]);
        
        $user = User::where('id',auth()->user()->id)->first();
          $this->OrderData['pin_code'] = $vaildateData['pin_code'];
          $this->OrderData['address'] = $vaildateData['address'];
          $this->OrderData['delivery_date'] = $vaildateData['delivery_date'];
          $this->OrderData['location_type'] = $vaildateData['location_type'];
          $this->OrderData['prefer_delivery_time'] = $vaildateData['prefer_delivery_time'];   
          $this->OrderData['delivery_instructions'] = $vaildateData['delivery_instructions']; 
       
          session(['data' => $this->OrderData]);
        
        
          
        
        $data = [
            //Fill required data
            'InvoiceValue'       =>  $this->TotalProductPrice(),
            'CustomerName'       => $vaildateData['fullname'],
            'MobileCountryCode'=> $vaildateData['mobile_country_code'],
            'CustomerMobile'=> $vaildateData['phone'],
            'DisplayCurrencyIso'=> $vaildateData['currency_iso_code'],
            'NotificationOption' => 'LNK', //'SMS', 'EML', or 'ALL'
            'CustomerEmail'      => $vaildateData['email'],
            'CallBackUrl'        => 'http://127.0.0.1:8002/callback',
            'ErrorUrl'           => 'http://127.0.0.1:8002/error-pay', //or 'https://example.com/error.php'
            'Language'           => $vaildateData['language'],
            'Currency'=>$vaildateData['currency_iso_code'],
        
          
             
              
        ];
      $response=  $this->fatoorasevices->sendPayment($data);
      
      $InvoiceId = $response['Data']['InvoiceId']; 
      $transaction = Transaction::create([
         'user_id'=>auth()->user()->id,
         'invoice_id'=>$InvoiceId,
         'invoice_value'=>$this->TotalProductPrice(),
      ]);
     return redirect($response['Data']['InvoiceURL']);

      
    }
    public function PaymentCallback(Request $request){
        $paymentId= $request->paymentId;
        $data=[
          'Key'=> $paymentId,
          'KeyType' => 'PaymentId'
        ];
        $response = $this->fatoorasevices->getPaymentStatus($data);
        if($response['Data']['InvoiceStatus'] == 'Paid' && $response['IsSuccess'] == true){
            $transaction = Transaction::where('invoice_id',$response['Data']['InvoiceId'])->first();
            $userId= $transaction->user_id;
            $carts = Cart::where('user_id',$userId)->get();
             $this->OrderData = session('data', []);
          
            $order = Order::create([
                'user_id'=>$userId,
                'tracking_no'=>'Mo-Do-'.random_int(10000,20000),
                'fullname'=>$response['Data']['CustomerName'],
                'email'=>$response['Data']['CustomerEmail'],
                'phone'=>$response['Data']['CustomerMobile'],
                'pincode'=>$this->OrderData['pin_code'],
                'address'=>$this->OrderData['address'],
                'status_message'=>'in progress',
                'delivery_date'=>$this->OrderData['delivery_date'],
                'payment_mode'=>'Online Payment',
                'location_type'=>$this->OrderData['location_type'],
                'prefer_delivary_time'=>$this->OrderData['prefer_delivery_time'],
                'delivary_instructions'=>$this->OrderData['delivery_instructions']
            ]);
            foreach ($carts as $cartitem) {
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
           if(Cart::where('user_id',$userId)->count() > 0){ 
             Cart::where('user_id',$userId)->delete();
             if ($order->users && $order->users->DiscountCode) {
                         
                $data = [
                    'id'=>$order->id,
                    'user_id'=>$order->user_id,
                    'tracking_no'=>$order->tracking_no,
                    'fullname'=>$order->fullname,
                    'status_message'=>'in progress',
                    'delivery_date'=>$order->delivery_date,
                    'payment_mode'=>'Online Payment',
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
                    'payment_mode'=>'Online Payment',
                    'created_at'=>$order->created_at->format('Y-m-d'),
                    'location_type'=>$order->location_type,
                    'discount_code'=>'__'
                ];
            }
   
            broadcast(new OrderEvent($data));
        
             return redirect()->to('thank-you')->with('message','Payment Successfully');

          }else{
            session()->flash('message','Something Went Wrong');
          }
        }
  
        
    }
}
