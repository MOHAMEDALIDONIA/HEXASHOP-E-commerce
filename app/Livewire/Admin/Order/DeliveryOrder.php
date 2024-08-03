<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveryOrder extends Component
{
    use WithPagination;
    public $order_delivary_today;
    public function cancel($order_id){
      $order_cancel = Order::findOrFail($order_id);
      $order_cancel->update([
          'status_message'=>'cancelled'
      ]);
    }
    public function complete($order_id){
        $order_cancel = Order::findOrFail($order_id);
        $order_cancel->update([
            'status_message'=>'completed'
        ]);
      }
    public function render()
    {
        $today = Carbon::now()->format('Y-m-d');
        $this->order_delivary_today=Order::whereDate('delivery_date','=',$today)->get();
        return view('livewire.admin.order.delivery-order');
    }
}
