<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;

class Wishlist extends Model
{
    use HasFactory;
    protected $table='wishlist';
    protected $fillable = [
        'user_id',
       'product_id',
        
    ];
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class,'product_id','id');

    }
}