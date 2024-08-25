<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Base\ShowComments;
use App\Base\Traits\UuidGenerator;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    use UuidGenerator;

    public function GetAllProducts()
    {
        return app(ServiceWrapper::class)(fn() => Product::latest()->paginate());
    }

    public function CreateProduct(array $inputs, Request $request)
    {
        return app(ServiceWrapper::class)(
            function() use($inputs, $request)
            {
                // $uuid = UuidGenerator::Uuid(Product::all());
                $product = Product::create($inputs);
                // $product->uuid = $uuid;
                $product->user_id = auth()->id();
                $product->category_id = (Category::where('name', $request->category_name)->firstOrFail())->id;
                $product->save();
                return $product;

            },
            'Product Createed to Records!'
        );
    }


    public function ShowProduct(object $product)
    {
        $product_info = [
            'title' => $product->title,
            'creator' => (User::where('id', $product->user_id)->first())->name,

            // 'category' => $product->category_name,
            'desc' => $product->desc,
            'price' => $product->price,

            'image' => $product->image ?? config('app.url').'/uploads/no_img.jfif',
            'rate' => $product->rate_avg,
            'modified' => $product->updated_at->diffForHumans(),

            'contact info' => (User::where('id', $product->user_id)->first())->email,
            'comments' => ShowComments::product_comments($product),
        ];
        return app(ServiceWrapper::class)(fn() => $product_info);
    }

    public function UpdateProduct(array $inputs, object $product)
    {
        return app(ServiceWrapper::class)(fn() => $product->update($inputs), 'Product Updated on Records!');
    }

    public function DeleteProduct(object $product)
    {
        return app(ServiceWrapper::class)(
            function() use($product)
            {
                if ($product->image)
                    Storage::disk('liara')->delete($product->image);
                return $product->delete();
            }
        );
    }

}
