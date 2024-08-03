<?php

namespace App\Livewire\cart;

use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Cart;
use App\Models\User;

class CartShow extends Component
{   
    public $cartlist,$TotalPrice=0 ,$user,$discount_code,$discount_percentage;
    public function decrementQuantity(int $cart_id)  {
        $cartitem = Cart::where('id',$cart_id)->where('user_id',auth()->user()->id)->first();
        if ($cartitem) {
          if ($cartitem->ProductColor()->where('color_id',$cartitem->product_color_id)->exists()) {
             $productcolor = $cartitem->productColor()->where('id',$cartitem->product_color_id)->first(); 
            if ($cartitem->quantity > $productcolor->quantity ) {
                session()->flash('error','Only'.$productcolor->quantity.'Quantity Available');
                return false;
              } else {
              
                if($cartitem->quantity <= 0){
                    
                    session()->flash('error',"i can't decrement any more ");
                    return false;
                }
                $cartitem->decrement('quantity');
                 session()->flash('message','Quantity Updated');
                 return false;
            }
          } else {
            if($cartitem->quantity > $cartitem->product->quantity){
                session()->flash('error','Only'.$cartitem->product->quantity.'Quantity Available');
                return false;
              } else {
                 
                if($cartitem->quantity <= 0){
                    
                    session()->flash('error',"i can't decrement any more");;
                    return false;
                }
                 $cartitem->decrement('quantity');
                 session()->flash('message','Quantity Updated');
                 return false;
            }
          }
       
        } else {
            session()->flash('error','Something Went Wrong!');
            return false;
        }
    
        
    }
    public function incrementQuantity(int $cart_id)  {
       $cartitem = Cart::where('id',$cart_id)->where('user_id',auth()->user()->id)->first();
    
        if ($cartitem) {
          if ($cartitem->ProductColor()->where('id',$cartitem->product_color_id)->exists()) {
              $productcolor = $cartitem->productColor()->where('id',$cartitem->product_color_id)->where('product_id',$cartitem->product_id)->first(); 
            if ($cartitem->quantity > $productcolor->quantity ) {
                session()->flash('error','Only'.' '.$productcolor->quantity.' '.'Quantity Available');
                return false;
            }elseif($cartitem->quantity == $productcolor->quantity){
                session()->flash('error',"i can't increment any more Quantity Available:(".$productcolor->quantity.")");
                return false;
            } else{
                $cartitem->increment('quantity');
                session()->flash('message','Quantity Updated');
                return false;
            }
              
            
               
               
                 
            
          } else {
            if($cartitem->quantity > $cartitem->product->quantity){
                session()->flash('error','Only'.' '.$cartitem->product->quantity.' '.'Quantity Available');
                return false;
              }elseif($cartitem->quantity == $cartitem->product->quantity){
                session()->flash('error',"i can't increment any moreQuantity Available:(".$cartitem->product ->quantity.")");
                return false;
            } else {
                 $cartitem->increment('quantity');
                 session()->flash('message','Quantity Updated');
                 return false;
            }
          }
       
        } else {
            
            session()->flash('error','Something Went Wrong!');
            return false;
        }
    
        
    }
    public function removeCartItem(int $cart_id){
        $cartitemremove= Cart::where('id',$cart_id)->where('user_id',auth()->user()->id)->first();
        if ($cartitemremove) {
            $cartitemremove->delete();
            session()->flash('message','cart deleted Successfully');
            return false;
        } else {
            session()->flash('error','Something Went Wrong!');
            return false;
        }
        
     

    }
    // public function DiscountCode(){
    //   $this->user =User::where('id',auth()->user()->id)->first();
    //    if ($this->user->DiscountCode()->where('user_id',auth()->user()->id)->where('discount_code',$this->discount_code)->exists()) {
    //       $discount_user = $this->user->DiscountCode()->where('user_id',auth()->user()->id)->where('discount_code',$this->discount_code)->first();
    //         $this->discount_percentage = $discount_user->discount_percentage;
    //         session()->flash('message','Added Discount Successfully');
    //         return false;

    //    } else {
    //     session()->flash('error','Please,Enter correct code');
    //     return false;
    //    }
       
    // }

    public function render()
    {   
        $this->cartlist = Cart::where('user_id',auth()->user()->id)->get();
        $this->user =User::where('id',auth()->user()->id)->first();
        return view('livewire.cart.cart-show',[
            'cartlist'=>$this->cartlist,
            'user'=>$this->user
        ]);
    }
}
