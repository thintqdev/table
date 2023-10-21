<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
        'title',
        'content',
        'started_at',
        'ended_at',
        'type',
        'max_uses',
        'used',
        'code',
        'minimum_purchase',
        'maximum_discount',
        'notification_flag',
    ];

    protected $dates = ['started_at', 'ended_at'];

    protected $casts = [
        'type' => 'boolean',
        'notification_flag' => 'boolean',
    ];
}
