<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'shop_id',
        'customer_id',
        'table_id',
        'order_date',
        'payment_status',
        'total_amount',
        'price_unit',
    ];
}
