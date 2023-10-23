<?php

namespace App\Services\Admin;

use App\Models\Product;

class ProductService extends AbstractService
{
    public function getProducts($search, $limit, $sortBy, $sortType)
    {
        $query = Product::with('shop')->where('name', 'LIKE', '%'.$search.'%');

        if ($this->userShop()) {
            $query->where('shop_id', $this->userShop());
        }

        $products = $query->orderBy($sortBy ?? 'created_at', $sortType ?? 'desc')
            ->paginate($limit ?? config('const.paginate'));

        $products->getCollection()->each(function ($product) {
            $product->append(['media', 'shop_name'])->makeHidden(['uploads', 'shop']);
        });

        return $products;
    }

    public function createProduct($data)
    {
        $data['shop_id'] = $this->user()->shop_id;
        $product = Product::create($data);

        return $product;
    }
}
