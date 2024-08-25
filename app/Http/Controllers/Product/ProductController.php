<?php

namespace App\Http\Controllers\Product;

use App\Base\Traits\DeleteImage;
use App\Base\Traits\FinalValidation;
use App\Base\Traits\HasPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductDeleteRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index()
    {
        $result = $this->productService->GetAllProducts();
        return $result;
    }

    public function store(ProductStoreRequest $request)
    {
        $result = $this->productService->CreateProduct(FinalValidation::isImageInRequest($request, 'Product'), $request);
        return $result;
    }

    public function show(Request $request, Product $product)
    {
        $result = $this->productService->ShowProduct($product);
        return $result;
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $result = $this->productService->UpdateProduct(FinalValidation::isImageInRequest($request, 'Product', $product), $product);
        return $result;
    }

    public function destroy(ProductDeleteRequest $request, Product $product)
    {
        $result = $this->productService->DeleteProduct($product);
        return $result;
    }

    public function delImg($product_id)  // Delete Image
    {
        $product = Product::where('id', $product_id)->firstOrFail();
        return DeleteImage::PerformDelete($product);
    }
}
