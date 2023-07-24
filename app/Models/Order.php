<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'image',
        'price',
        'user_id',
        'product_title',
        'product_id',
        'payment_status',
        'delivery_status',
        'qty',
    ];
}
