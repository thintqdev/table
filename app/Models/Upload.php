<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Upload extends Model
{
    use HasFactory;

    protected $table = 'uploads';

    protected $appends = ['temporary_url'];

    protected $fillable = [
        'file_path', 'uploadable_id', 'uploadable_type', 'temporary_id'
    ];

    public function temporaryUrl(): Attribute
    {
        return Attribute::make(function () {
            return Storage::disk('s3')->temporaryUrl(
                $this->file_path, now()->addMinute()
            );
        });
    }
}
