<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'end_time',
        'start_time',
        'price',
        'category',
        'discount',
        'description',
        'status',
        'image'
    ];
    public function food()
    {
        return $this->belongsTo(\App\Models\Product::class, 'food_id');
    }
}
