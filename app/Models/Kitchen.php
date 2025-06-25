<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    protected $fillable = [
        'food_id',
        'order_no',
        'table_no',
        'user_id',
        'quantity',
        'timer',
        'kitchen_status',
    ];
   public function food()
    {
        return $this->belongsTo(Product::class, 'food_id');
    }
}
