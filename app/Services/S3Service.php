<?php

namespace App\Services;

use App\Models\QRStamp;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Str;

class S3Service
{
    public function uploadFile($file, $folder, $uuid = null)
    {
        $fileName = now()->format('dmY_His') . '_' . Str::random() . '.' . $file->extension();
        $filePath = $folder . $fileName;
        Storage::disk('s3')->put($filePath, file_get_contents($file));
        Upload::create([
            'file_path' => $filePath,
            'temporary_id' => $uuid
        ]);

        return true;
    }

    public function uploadQRCodeFile($file, $folder, $qrStampId) {
        $fileName = now()->format('dmY_His') . '_' . Str::random() . '.png';
        $filePath = $folder . $fileName;
        Storage::disk('s3')->put($filePath, $file);
        Upload::create([
            'file_path' => $filePath,
            'uploadable_id' => $qrStampId,
            'uploadable_type' => QRStamp::class,
        ]);
    }
}
