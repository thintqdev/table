<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
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
        $this->authorize('create');
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
        $shops = $this->shopService->getShops($status, $sortBy, $sortType, $limit, $search);

        return response()->apiSuccess($shops);
    }

    public function show(Shop $shop)
    {
        return response()->apiSuccess($shop);
    }

    public function update(Shop $shop, Request $request)
    {
        $result = $this->shopService->updateShop($shop, $request->all());

        return response()->apiSuccess($result);
    }

    public function destroy(Shop $shop)
    {
        $deleted = $shop->delete();

        return response()->apiSuccess($deleted);
    }
}
