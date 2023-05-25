<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UploadFileRequest;
use App\Models\Product;
use App\Services\Admin\ProductService;
use App\Services\S3Service;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $s3Service;
    protected $productService;

    public function __construct(S3Service $s3Service, ProductService $productService)
    {
        $this->s3Service = $s3Service;
        $this->productService = $productService;
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

    public function index(Request $request)
    {
        $search = $request->get('search');
        $limit = $request->get('limit');
        $sortBy = $request->get('sort_by');
        $sortType = $request->get('sort_type');
        $products = $this->productService->getProducts($search, $limit, $sortBy, $sortType);

        return response()->apiSuccess($products);
    }

    public function store(Request $request)
    {
        $product = $this->productService->createProduct($request->all());

        return response()->apiSuccess($product);
    }

    public function show(Product $product)
    {
        return response()->apiSuccess($product->append('media')->makeHidden('uploads'));
    }

    public function update(Request $request)
    { }

    public function delete(Request $request)
    { }
}
