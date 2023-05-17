<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;


    public const CONFIRMABLE_TYPE = [
        'FORGOT_PASSWORD' => 'forgot_password'
    ];

    protected $table = 'confirmations';

    protected $fillable = ['confirmable_id', 'confirmable_type', 'code', 'expires_at'];

}
