<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRStamp extends Model
{
    use HasFactory;

    protected $table = 'qr_stamps';

    public const QRSTAMP_FOLDER = 'qrstamps/';

    protected $fillable = [
        'title',
        'shop_id',
        'quantity',
        'one_time_flag',
        'started_at',
        'ended_at',
        'sha256_hash',
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

    public function upload()
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }

    public function qrStampUrl(): Attribute
    {
        return Attribute::make(function () {
            return $this->upload->temporary_url;
        });
    }
}
