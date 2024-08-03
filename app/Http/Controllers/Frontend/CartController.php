<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductColor;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\CartRequestForm;

class CartController extends Controller
{
    public function index(){
        $categories = Category::where('status','0')->get();
       return view('frontend.cart.index',compact('categories'));
    } 
    public function AddToCart(int $product_id,CartRequestForm $request){
        $product = Product::where('id',$product_id)->where('status',0)->first();
 
        if (Auth::check()) { //check if user auth or not
            if ($product->productColors()->count() > 0) { //check if exists product color or not
                
               $vaildtion =$request->validate([
                'color'=>'required',
                'quantity'=>'required'
               ]);
                $productcolor = $product->productColors()->where('id',$vaildtion['color'])->first();
                $quantityproductcolor= $productcolor->quantity;
                if($vaildtion['quantity'] > $quantityproductcolor ){// check if vaildtion['quantity'] bigger than productcolor->quantity or not
                    Alert::error('Only'.' '.$quantityproductcolor.' '.'Quantity Available. Please enter a smaller quantity')->showCloseButton()->buttonsStyling(false)->autoClose(2000);
                    return redirect()->back();
                }else{
                    if (Cart::where('product_id',$product_id)->where('user_id',auth()->user()->id)->where('product_color_id',$vaildtion['color'])->exists()) {
                        Alert::info('Product Already Added.please,go to my cart for any change')->showCloseButton()->buttonsStyling(false)->autoClose(2000);
                        return redirect()->back();
                    } else {
                        Cart::create([
                            'user_id'=>auth()->user()->id,
                            'product_id'=>$product_id,
                            'product_color_id'=>$vaildtion['color'],
                            'quantity'=>$vaildtion['quantity']
                        ]);
                        Alert::success('Product Added to Cart Successfully.please,go to my cart for any change')->showCloseButton()->buttonsStyling(false)->autoClose(2000);
                        return redirect()->back();

                    }
                    
    
                }
            } else {
                if($request->quantity > $product->quantity){// check if request->quantity bigger than product->quantity or not
                    Alert::error('Only '.' '.$product->quantity.' '.' Quantity Available. Please enter a smaller quantity')->showCloseButton()->buttonsStyling(false)->autoClose(2000);
                    return redirect()->back();
                }else{
                    if (Cart::where('product_id',$product_id)->where('user_id',auth()->user()->id)->exists()) {
                        Alert::info('Product Already Added.please,go to my cart for any change')->showCloseButton()->buttonsStyling(false)->autoClose(2000);
                        return redirect()->back();
                    } else {
                        Cart::create([
                            'user_id'=>auth()->user()->id,
                            'product_id'=>$product_id,
                            'quantity'=>$request->quantity
                        ]);
                        Alert::success('Product Added to Cart Successfully.please,go to my cart for any change')->showCloseButton()->buttonsStyling(false)->autoClose(2000);
                        return redirect()->back();

                    }
                    

                }   
            }
            
      
        } else {
          Alert::info('please,login to continue')->showCloseButton()->buttonsStyling(false)->autoClose(2000);

            return redirect()->back();
        }
        

    }
}
