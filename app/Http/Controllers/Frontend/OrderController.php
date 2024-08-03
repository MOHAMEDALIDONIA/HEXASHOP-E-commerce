<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function view(){
        $user_orders=  Order::where('user_id',auth()->user()->id)->get();
        $categories = Category::where('status','0')->get();
           return view('frontend.order.orderuser',compact('user_orders','categories'));
    }
    public function ViewOrderItems(){
        $order=  Order::where('user_id',auth()->user()->id)->first();
        $categories = Category::where('status','0')->get();
        return view('frontend.order.orderitemuser',compact('order','categories'));
    }
}
