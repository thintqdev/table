<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'shop_id',
        'is_active'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function shopName(): Attribute
    {
        return Attribute::make(function () {
            return $this->shop->shop_name;
        });
    }
}
