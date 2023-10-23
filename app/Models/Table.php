<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';

    public const TABLE_FOLDER = 'tables/csv/';

    protected $fillable = [
        'name',
        'location',
        'shop_id'
    ];
}
