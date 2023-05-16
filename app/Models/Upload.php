<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Eloquent
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'uploads';

    protected $fillable = [
        'file_path', 'uploadable_id', 'uploadable_type', 'temporary_id'
    ];
}
