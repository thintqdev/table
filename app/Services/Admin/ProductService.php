<?php

namespace App\Services\Admin;

use App\Models\Product;

class ProductService extends AbstractService
{
    public function getProducts($condition, $search, $limit, $sortField, $sortBy)
    {
        $products = Product::where($condition);
    }

    public function createProduct($data)
    {
        $data['shop_id'] = $this->user()->shop_id;
        $product = Product::create($data);

        return $product;
    }
}