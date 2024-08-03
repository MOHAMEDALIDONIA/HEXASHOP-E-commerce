<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable=[
           'website_name',
           'description',
           'address',
           'phone1',
           'phone2',
           'email',
           'facebook',
           'twitter',
           'instagram',
           'youtube',
           
    ];
}
