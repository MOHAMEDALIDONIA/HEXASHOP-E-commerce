<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Livewire\Checkout;
use App\Livewire\Checkout\CheckoutShow;

class ShowOrders extends Component
{   
    use WithPagination;
   
    public $orders ,$date,$status;
    protected $listeners = ['orderAdded' => 'updateorder'];

    public function filter(){
        $todaydate = Carbon::now()->format('Y-m-d');
        
        $orders = Order::when($this->date != Null,function($q) {
            return $q->whereDate('created_at',$this->date);
        }
       ,function ($q) use($todaydate){
            return $q -> whereDate('created_at',$todaydate);

        })->when($this->status != null,function($q) {
            return $q->where('status_message',$this->status);
        })->
        get();
        $this->orders = $orders;
        return false;
    }
    
    // #[On('orderAdded')]
    // public function updateorder()  {
    //   $checkout=new  CheckoutShow();
    //   $ordercheckout= $checkout->totalorders();
    //     $ordercheckout;
    // }
  
    public function mount(){
        $todaydate = Carbon::now()->format('Y-m-d');
        $this->date = Carbon::now()->format('Y-m-d');
        $this->orders =Order::whereDate('created_at',$todaydate)->get();
    }
  
    public function render()
    {
        $todaydate = Carbon::now()->format('Y-m-d');
        
   
        
        return view('livewire.admin.order.show-orders',[
              'orders' => $this->orders,
              
        ]);
    }
}
