<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Models\Like;

class LikeService
{
    public function CreateLike($product_id)
    {
        return app(ServiceWrapper::class)(
            function() use($product_id)
            {
                $like = Like::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product_id,
                ]);
                return $like;
            },
            "Like added"
        );
    }

    public function RemoveLike(object $like)
    {
        return app(ServiceWrapper::class)(fn() => $like->delete(), 'Like removed');
    }
}
