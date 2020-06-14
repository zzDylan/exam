<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order2 extends Model
{
    protected $table = 'orders';
    //use SoftDeletes;
    //protected $dates = ['deleted_at'];
    protected $guarded = [];
}
