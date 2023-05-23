<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UploadFileRequest;
use App\Models\Product;
use App\Services\S3Service;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $s3Service;

    public function __construct(S3Service $s3Service)
    {
        $this->s3Service = $s3Service;
    }

    public function uploadMediaProduct(UploadFileRequest $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $result = $this->s3Service->uploadFile($file, Product::PRODUCT_FOLDER, $request->uuid);
    
                return response()->apiSuccess($result, __('message.admin.success_upload_image'));
            }
        } catch (\Exception $e) {
            logger('ERROR_UPLOAD', [$e->getMessage()]);
            return response()->apiError([], $e->getMessage());
        }
    }
}
