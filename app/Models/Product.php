<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'price',
        'category',
        'description',
        'status',
        'image'
    ];
    public function food()
    {
        return $this->belongsTo(\App\Models\Product::class, 'food_id');
    }
}
