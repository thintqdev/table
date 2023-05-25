<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $limit = $request->get('limit');

        $categories = $this->categoryService->getCategories($search, $limit);

        return response()->apiSuccess($categories);
    }

    public function store(Request $request)
    {
        $category = $this->categoryService->createCategory($request->all());

        return response()->apiSuccess($category);
    }

    public function show(Category $category)
    {
        return response()->apiSuccess($category);
    }

    public function update(Category $category, Request $request)
    {
        $updated = $this->categoryService->updateCategory($category, $request->all());

        return response()->apiSuccess($updated);
    }

    public function destroy(Category $category)
    {
        $deleted = $category->delete();

        return response()->apiSuccess(true);
    }

    public function updateStatusCategories(Request $request)
    {
        $updated = $this->categoryService->updateStatusCategories($request->category_ids, $request->get('status'));

        return response()->apiSuccess(true);
    }

    public function deleteCategories(Request $request)
    {
        $this->categoryService->deleteCategories($request->category_ids);

        return response()->apiSuccess(true);
    }
}
