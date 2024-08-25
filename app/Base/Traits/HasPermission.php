<?php

namespace App\Base\Traits;

use App\Models\Comment;
use App\Models\Product;

trait HasPermission
{
    public static function IsAllowed($obj, $model=null)
    {
        if(gettype($obj) === 'object')
            return !!($obj->user_id === auth()->id() || auth()->user()->email === 'admin@gmail.com');

        if(gettype($obj) === 'string')
        {
            dd(request()->message);
            $obj = (int) $obj;
            switch($model)
            {
                case 'Comment':
                    $obj = Comment::where('id', $obj)->firstOrFail();
                    break;
            }
            return !!($obj->user_id === auth()->id() || auth()->user()->email === 'admin@gmail.com');
        }

    }
}
