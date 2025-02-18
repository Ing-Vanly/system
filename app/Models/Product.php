<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'brand',
        'price',
        'quantity',
        'weight',
        'warranty',
        'image',
        'user_id',
    ];
}
