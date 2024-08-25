<?php

namespace App\Http\Controllers\Category;

use App\Base\Traits\FinalValidation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
    }


    public function index()
    {
        $result = $this->categoryService->GetAllCategories();
        return $result;
    }


    public function store(CategoryStoreRequest $request)
    {
        $result = $this->categoryService->CreateCategory(FinalValidation::isImageInRequest($request, 'Category'));
        return $result;
    }


    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $result = $this->categoryService->UpdateCategory(FinalValidation::isImageInRequest($request, 'Category' ,$category), $category);
        return $result;
    }


    public function destroy(Category $category)
    {
        $result = $this->categoryService->DeleteCategory($category);
        return $result;
    }
}
