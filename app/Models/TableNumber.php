<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableNumber extends Model
{
    protected $fillable = [
        'table_no',
        'status'
    ];
}
