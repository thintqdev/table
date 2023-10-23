<?php

namespace App\Services\Admin;

use App\Models\Shop;

class ShopService extends AbstractService
{
    public function createShop($data)
    {
        $data['owner_id'] = $this->user()->id;
        if ($data['is_only_shop']) {
            $data['email'] = $this->user()->email;
            $data['representative_name'] = $this->user()->name;
        }
        $shop = Shop::create($data);

        return $shop;
    }

    public function getShops($status, $sortBy, $sortType, $limit, $search = '')
    {
        $shops = Shop::whereIn('status', $status ?? array_values(Shop::STATUS))
            ->where('shop_name', 'LIKE', '%'.$search.'%')
            ->orderBy($sortBy ?? 'created_at', $sortType ?? 'desc')
            ->paginate($limit ?? config('const.paginate'));

        return $shops;
    }

    public function updateShop($shop, $data)
    {
        return $shop->update($data);
    }
}
