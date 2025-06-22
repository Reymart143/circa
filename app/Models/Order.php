<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'customer_name',
        'address',
        'phone_no',
        'quantity',
        'total_amount',
        'status',
        'transaction_no'
    ];
}
