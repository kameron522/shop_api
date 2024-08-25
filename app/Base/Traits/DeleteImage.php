<?php

namespace App\Base\Traits;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Throwable;

trait DeleteImage
{
    public static function PerformDelete(object $obj)
    {
        if($obj->image)
        {
            Storage::disk('liara')->delete($obj->image);
            $obj->image = null;;
            $obj->save();
        }
        return $obj;
    }
}
