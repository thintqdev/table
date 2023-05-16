<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shopService;
    
    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function create(Request $request)
    {
        $shop = $this->shopService->createShop($request->all());

        return response()->apiSuccess($shop);
    }

    public function index(Request $request)
    {
        $status = $request->get('status');
        $search = $request->get('search');
        $sortBy = $request->get('sort_by');
        $sortType = $request->get('sort_type');
        $limit = $request->get('limit');
        $shops = $this->shopService->getShops($status, $search, $sortBy, $sortType, $limit);

        return response()->apiSuccess($shops);
    }
}
