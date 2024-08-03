<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountUser extends Model
{
    use HasFactory;
    protected $table='discount_users';
    protected $fillable = [
         'id',
         'user_id',
         'discount_code',
         'expiry_date',
         'discount_percentage'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
