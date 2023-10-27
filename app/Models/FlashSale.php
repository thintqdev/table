<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;

    protected $table = 'flash_sales';

    protected $fillable = [
        'shop_id',
        'started_at',
        'ended_at',
        'type',
        'max_uses',
        'used',
        'notification_flag',
    ];

    protected $dates = ['started_at', 'ended_at'];

    protected $casts = [
        'type' => 'boolean',
        'notification_flag' => 'boolean',
    ];
}
