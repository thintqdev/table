<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    public const PRODUCT_FOLDER = 'products/';

    protected $fillable = [
        'name',
        'description',
        'price',
        'shop_id',
        'rating',
        'status',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }
}
