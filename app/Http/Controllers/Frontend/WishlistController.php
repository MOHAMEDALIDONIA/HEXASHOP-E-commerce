<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use RealRashid\SweetAlert\Facades\Alert;



class WishlistController extends Controller
{
    public function index(){
     $wishlist =  Wishlist::where('user_id',auth()->user()->id)->get();
     $categories = Category::where('status','0')->get();
        return view('frontend.wishlist.index',compact('wishlist','categories'));
    }
    public function create($product_id){
        $product = Product::findOrfail($product_id);
        $category= Category::where('id',$product->category_id)->first();
        if(Auth::check()){
          if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$product_id)->exists()){

            Alert::info('already added to wishlist')->showCloseButton()->buttonsStyling(false)->autoClose(2000);

            return redirect()->back()->with(['category'=>$category]);
          }else{
            Wishlist::create([
                'user_id'=>auth()->user()->id,
                'product_id'=> $product_id
            ]);
            Alert::success('add to your wishlist successfully')->buttonsStyling(false)->showCloseButton()->autoClose(2000);
            return redirect()->back()->with(['category'=>$category]);
          }
        }else{
          Alert::info('please,login to continue')->showCloseButton()->buttonsStyling(false)->autoClose(2000);

          return redirect()->back()->with(['category'=>$category]);
        }
        
    }
    public function destory($wishlistitem_id){
      if(Auth::check()){
        Wishlist::where('id',$wishlistitem_id)->delete();
       return redirect()->back()->with(['message'=>'this wishlistitem deleted']);
      }else{
        return redirect()->back()->with(['message'=>'please,login'] );
      }

    }
}
