<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $fillable = [
       'main_name',
       'end_time',
       'start_time',
    ];
}
