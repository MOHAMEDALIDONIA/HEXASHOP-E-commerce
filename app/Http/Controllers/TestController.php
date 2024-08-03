<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function test1(){

        // $array = ['mohamed','ali', 'mohamed','donia'];
        // foreach($array as $key => $arr){
        //     echo $arr;
        //     echo '<br>';
        //     echo $key;
        //     echo '<br>';
        // }
        // return 'finished';
        // $cart =Cart::where('user_id',auth()->user()->id)->get();
        // foreach($cart as $cartitem){
         
        //  $productcart=$cartitem->product()->where('id',$cartitem->product_id)->get();
        //  echo'<pre>';
        //   print_r($cartitem->productColor()->where('id',$cartitem->product_color_id)->first()->quantity);
        //  echo '</pre>' ;
         
        // }
         $today=Carbon::now()->format('Y-m-d');
        $order_delivary_today=Order::whereDate('delivery_date','=',$today)->get();
        $order_delivary_today;
        // foreach($order_delivary_today as $order){
        //     echo'<pre>';
        //       print_r($order);
        //      echo '</pre>' ;
        // }
    }
   
}
