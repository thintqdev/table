<?php

namespace App\Services;

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
}
