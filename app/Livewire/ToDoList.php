<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Task;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ToDoList extends Component
{
    #[Validate]
    protected $rules=[
        'task'=>'required|string'
    ];
    public $task,$tasks=[];
  
    public function add(){
      
        $this->validate();
    
        $item = Task::create(['task' => $this->task]);
        $this->tasks[] = $item;
        $this->reset('task');

       
    }
    public function remove(int $task_id){
       $taskremove = Task::where('id',$task_id)->first();
       $taskremove->delete();
       return false;
    }
  
    public function render()
    {
     
        $this->tasks = Task::get();
        // $today=Carbon::now()->format('Y-m-d');
        // $order_delivary_today=Order::whereDate('delivery_date','=',$today)->get();
        
        // foreach($order_delivary_today as $order){
        //   $item =Task::create(['task'=>'You must deliver the order today to('.$order->users->email.')user and No.of order->('.$order->id.')and date:'.$order->created_at]);
        //   $this->tasks[] = $item;
        // }
    
        return view('livewire.to-do-list',[
            'tasks'=>$this->tasks
        ]);
    }
}
