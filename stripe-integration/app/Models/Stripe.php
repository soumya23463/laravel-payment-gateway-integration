<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stripe extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'payment_id',
        'product_name',
        'quantity',
        'amount',
        'currency',
        'customer_name',
        'customer_status',
        'payment_method',
    ];
}
