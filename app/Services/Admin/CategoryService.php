<?php

namespace App\Services\Admin;

use App\Models\Category;

class CategoryService extends AbstractService
{
    public function createCategory($data)
    {
        $data['shop_id'] = $this->user()->shop_id;

        $category = Category::create($data);

        return $category;
    }

    public function getCategories($search, $limit)
    {
        $query = Category::with('shop')->where('name', 'LIKE', '%'.$search.'%');

        if (! is_null($this->user()->shop_id)) {
            $query->where('shop_id', $this->user()->shop_id);
        }

        $categories = $query->paginate($limit ?? config('const.paginate'));
        $categories->getCollection()->each(function ($category) {
            $category->append('shop_name');
            $category->makeHidden('shop');
        });

        return $categories;
    }

    public function updateCategory($category, $data)
    {
        return $category->update($data);
    }

    public function deleteCategories($categoryIds)
    {
        return Category::whereIn('id', $categoryIds)->delete();
    }

    public function updateStatusCategories($categoryIds, $status)
    {
        Category::whereIn('id', $categoryIds)->update([
            'is_active' => $status,
        ]);
    }
}
