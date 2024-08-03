<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\ProductColor;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable = [
         'id',
         'category_id',
         'name',
         'description',
         'original_price',
         'selling_price',
         'discount_price',
         'quantity',
         'tranding',
         'status'
   
    ];
    public function category(){
        return $this->belongsTo(Category::class ,'category_id' ,'id');
    }
    public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function productColors(){
        return $this->hasMany(ProductColor::class,'product_id','id');
    }
}
