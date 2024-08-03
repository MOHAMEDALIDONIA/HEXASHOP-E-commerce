<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WelcomePage;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
class FrontendController extends Controller
{
    public function index(){
      
      $banner_categories = Category::where('banner_status','1')->take(4)->get();
      $latest_products = Product::where('status','0')->latest()->take(10)->get();
      $tranding_products = Product::where('status','0')->where('tranding','1')->latest()->take(10)->get();
      $offers =Product::where('status','0')->where('discount_price','!=',null)->latest()->take(10)->get();
      return view('frontend.welcome',compact('banner_categories','latest_products','tranding_products','offers')) ;
    }
    public function ProductsCategory($category_id){
     
      $category = Category::where('id',$category_id)->first();
      $products = Product::where('category_id',$category_id)->get();
      return view('frontend.products.productscategory',compact('products','category'));
    }
    public function productview(int $product_id){
    
      $product = Product::findOrfail($product_id);
      return view('frontend.products.view',compact('product'));
    }
    public function products(){
      $products = Product::where('status','0')->latest()->paginate(200);
     
      return view('frontend.products.index',compact('products'));
    }
    public function trandingproducts(){
      $products = Product::where('status','0')->where('tranding','1')->latest()->paginate(200);
   
      return view('frontend.products.tranding',compact('products'));
    }
    public function viewoffers() {
      $products = Product::where('status','0')->where('discount_price','!=',null)->latest()->paginate(200);
   
      return view('frontend.products.offers',compact('products'));
    }
    public function thankyou(){
    
      return view('frontend.thank-you');
    }
    public function searchproducts(Request $request){
      if ($request->search) {
       
        $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->orWhere('description','LIKE','%'.$request->search.'%')->latest()->paginate(20);
        return view('frontend.pages.search',compact('searchProducts'));
      }else{
          return redirect()->back()->with('message','Empty Search');

      }
    }
}
