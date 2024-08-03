<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    public function index(){
        $categories = Category::where('status',0)->get();
      
        return view('frontend.checkout.index',compact('categories'));
    }
}
