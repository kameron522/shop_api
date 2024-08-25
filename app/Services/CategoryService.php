<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Base\Traits\CategoryTraits\CategoryUuidGenerator;
use App\Base\Traits\UuidGenerator;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    use UuidGenerator;

    public function GetAllCategories()
    {
        return app(ServiceWrapper::class)(fn() => Category::latest()->get(), 'All Categries retrieved');
    }

    public function CreateCategory(array $inputs)
    {
        return app(ServiceWrapper::class)(
            function() use($inputs)
            {
                // $uuid = UuidGenerator::Uuid(Category::all());
                $category = Category::create($inputs);

                // $category->uuid = $uuid;
                $category->save();

                return $category;
            },
            'Category Createed'
        );
    }

    public function UpdateCategory(array $inputs, object $category)
    {
        return app(ServiceWrapper::class)(fn() => $category->update($inputs), 'Category Updated');
    }

    public function DeleteCategory(object $category)
    {
        return app(ServiceWrapper::class)(
            function() use($category)
            {
                if ($category->image)
                    Storage::disk('liara')->delete($category->image);
                return $category->delete();
            }
        );
    }
}
