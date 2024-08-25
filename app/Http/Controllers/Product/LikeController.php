<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Services\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct(private LikeService $likeService)
    {
    }

    public function store($product_id)
    {
        if($this->HasLiked($product_id))
            return response()->json(['error' => 'you have already like this product'], status: 400);

        $result = $this->likeService->CreateLike($product_id);
        return $result;
    }

    public function destroy(Like $like)
    {
        $result = $this->likeService->RemoveLike($like);
        return $result;
    }

    public function HasLiked($product_id)
    {
        $like = Like::where('product_id', $product_id)->where('user_id', auth()->id())->first();
        if($like)
            return true;
        return false;
    }
}
