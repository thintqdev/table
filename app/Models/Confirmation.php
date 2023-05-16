<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Confirmation extends Eloquent
{
    use HasFactory;


    public const CONFIRMABLE_TYPE = [
        'FORGOT_PASSWORD' => 'forgot_password'
    ];

    protected $table = 'confirmations';

    protected $fillable = ['confirmable_id', 'confirmable_type', 'code', 'expires_at'];

}
