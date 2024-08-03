<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable = [
        'id',
        'user_id',
        'tracking_no',
        'fullname',
        'email',
        'phone',
        'pincode',
        'address',
        'status_message',
        'payment_mode',
        'location_type',
        'delivery_date',
        'prefer_delivary_time',
        'delivary_instructions'
   
    ];
    public function orderItem(){
        return $this->hasMany(Orderitem::class,'order_id','id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
