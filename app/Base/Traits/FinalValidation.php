<?php

namespace App\Base\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FinalValidation
{
    public static function isImageInRequest(Request $request, string $model, object $object = null)
    {
        $model = strtolower($model);
        if ($request->has('image'))
        {
            if ($object &&  $object->image)
                Storage::disk('liara')->delete($object->image);

            $image_path = $request->file('image')->store('uploads/images/' . $model, 'liara');
            $inputs = $request->validated();
            $inputs['image'] = $image_path;
        }
        else
        {
            $inputs = $request->validated();
        }
        return $inputs;
    }

}
