<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request){
    
        $todaydate = Carbon::now()->format('Y-m-d');
        
        $orders = Order::when($request->date != Null,function($q) use($request){
            return $q->whereDate('created_at',$request->date);
        }
       ,function ($q) use($todaydate){
            return $q -> whereDate('created_at',$todaydate);

        })->when($request->status != null,function($q) use($request){
            return $q->where('status_message',$request->status);
        })->paginate(2);
        return view('admin.orders.index',compact('orders'));
    }
    public function view($order_id,$user_id){
        $order = Order::where('id',$order_id)->first();
        $discount_user = User::where('id',$user_id)->first();
        if($order){
            return view('admin.orders.view',compact('order','discount_user'));

        }else{
            return redirect()->back()->with('message','No Order Found');
        }

    }
    public function ViewInvoice($order_id){
       $order = Order::findOrFail($order_id);
       if ($order)
         {
          return view('admin.invoice.viewinvoice',compact('order'));
       } else {
         return redirect()->back()->with(['message','Something Is Wrong!']);
       }
       
    }
    public function PrintInvoice($order_id){
        $order = Order::findOrFail($order_id);
        if ($order)
          {
           return view('admin.invoice.printinvoice',compact('order'));
        } else {
          return redirect()->back()->with(['message','Something Is Wrong!']);
        }
        
     }
     public function DownloadInvoice($order_id){
        $order = Order::findOrFail($order_id);
        $todaydate = Carbon::now()->format('Y-m-d');
        $data = ['order'=>$order];
        $pdf = FacadePdf::loadView('admin.invoice.viewinvoice',$data);
       return $pdf->download('invoice-'.$order->id.'-'.$todaydate.'.pdf');
     }
     public function UpdateStatusOrder(int $order_id,Request $request) {
        $order = Order::findOrFail($order_id);
        if ($order) {
            $order->update([
                'status_message'=>$request->order_status ?? 'in progress'
            ]);
            return redirect()->back()->with('message','Updated Status Successfully');
        } else {
            return redirect()->back()->with('message','Something Is Wrong!');
        }
        
     }
     public function SendInvoiceByEmail($order_id,$user_id){
        $order = Order::findOrFail($order_id);
        
        Mail::send('admin.invoice.viewinvoice',['order'=>$order],function($message)use($order){
            $user_email = User::where('id',$order->user_id)->first();
            $message->to($user_email->email);
            $message->subject('Send Your Invoice');
       });
       return redirect('admin/orders/view/'.$order->id.'/'.$user_id)->with('message','we have emailed Invoice user');
     }
     public function destory($order_id){
        $orderitem = Order::where('status_message','!=','completed')->with('orderItem')->findOrFail($order_id);
       foreach($orderitem->orderItem as $item){
           $product = Product::where('id',$item->product_id)->first();
           $product->update([
             'quantity'=> $product->quantity + $item->quantity
           ]);
            
           if($item->product_color_id != null){
            $productcolor= ProductColor::where('id',$item->product_color_id)->first();
            $productcolor->update([
               'quantity'=>$productcolor->quantity + $item->quantity
            ]);
              
           }
       }
       $order = Order::findOrFail($order_id);
       $order->delete();
       $order->orderItem()->delete();
        return redirect()->back()->with('message','order Deleted Successfully');
     }
}
