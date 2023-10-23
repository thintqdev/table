<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'shops';

    public const STATUS = [
        'ACTIVE' => 1,
        'LOCKED' => 2,
        'INACTIVE' => 99,
    ];

    protected $fillable = [
        'shop_name', 'description', 'address', 'phone', 'fax', 'facebook_url', 'email', 'representative_name', 'status', 'owner_id',
        'latitude', 'longitude', 'open_hour', 'close_hour',
    ];

    protected $casts = [
        'open_hour' => 'time',
        'close_hour' => 'time',
    ];

    protected $hidden = ['password'];

    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function qrStamps()
    {
        return $this->hasMany(QRStamp::class);
    }
}
