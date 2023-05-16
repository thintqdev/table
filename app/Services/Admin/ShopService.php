<?php

namespace App\Services\Admin;

use App\Models\Shop;

class ShopService extends AbstractService
{
    public function createShop($data)
    {
        $shop = Shop::create($data);

        return $shop;
    }

    public function getShops($status, $search, $sortBy, $sortType, $limit)
    {
        $shops = Shop::query();
        if (!empty($status)) {
            $shops->whereIn('status', $status);
        }

        // if (!empty($search)) {
        //     $shops->where('shop_name', 'LIKE', '%' . $search . '%');
        // }

        // if ($sortBy) {
        //     $shops->sortBy($sortBy, $sortType);
        // } else {
        //     $shops->sortBy('created_at', 'desc');
        // }

        $shops->paginate($limit ?? 10);
        return $shops;
    }
}