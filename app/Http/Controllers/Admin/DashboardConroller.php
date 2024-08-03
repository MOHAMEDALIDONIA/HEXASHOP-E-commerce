<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardConroller extends Controller
{
    public function index(){
        $products = Product::where('quantity','!=',null)->get();
        $total_products = $products->sum('quantity');
        $totalOriginalPrice = $products->reduce(function ($carry, $product) {
            return $carry + ($product->quantity * $product->original_price);
        }, 0);
        $totalSellingPrice = $products->reduce(function ($carry, $product) {
            return $carry + ($product->quantity * $product->selling_price);
        }, 0);
        $totalDiscountPrice = $products->reduce(function ($carry, $product) {
            return $carry + ($product->quantity * $product->discount_price);
        }, 0);
        $categories = Category::all();
        $today = Carbon::now()->format('Y-m-d');
        $orders_today = Order::whereDate('created_at',$today)->paginate(5);
        $total_orders= Order::all()->count();
        $thisMonth = Carbon::now()->format('m');
        $thisMonthOrders = Order::whereMonth('created_at',$thisMonth)->count();
        $thisYear = Carbon::now()->format('Y');
        $thisYearOrders = Order::whereYear('created_at',$thisYear)->count();
        $order_cash = Order::where('payment_mode','Cash ON Delivery')->get();
        $order_online = Order::where('payment_mode','Online Payment')->get();
        $users = User::count();
        $latest_users=User::withCount('Order')
        ->orderBy('Order_count', 'desc')
        ->take(10) // Adjust the number of users you want to retrieve
        ->get();
        $total_order_items = OrderItem::get();
        return view('admin.dashboard',compact('total_products','total_orders','order_cash','order_online' ,'totalOriginalPrice','totalSellingPrice'
                                               ,'totalDiscountPrice','categories','orders_today','thisMonthOrders','thisYearOrders'
                                              ,'users','total_order_items','latest_users'));
    }
}
