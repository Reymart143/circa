<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'food_id',
        'user_id',
        'quantity',
        'flavor',
        'table_no',
        'size',
        'order_no',
        'total_price',
        'customer_amount',
        'payment_status',
        'kitchen_status',
        'payment_type'
    ];
}
