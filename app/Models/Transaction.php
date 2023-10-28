<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_trans',
        'name',
        'type_car',
        'merk_car',
        'plat',
        'type_wash',
        'information',
        'price',
        'discount',
        'additional_discount',
        'total_price',
        'user_in',
        'user_out'
    ];
}
