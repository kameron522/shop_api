<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Base\Traits\CommentTraits\CommentUuidGenerator;
use App\Base\Traits\UuidGenerator;
use App\Models\Comment;

class CommentService
{
    use UuidGenerator;

    public function CreateComment(array $inputs, $product_id)
    {
        return app(ServiceWrapper::class)(
            function() use($inputs, $product_id)
            {
                $comment = Comment::create($inputs);
                $comment->user_id = auth()->id();
                $comment->product_id = $product_id;
                $comment->save();
                return $comment;
            },
            'Comment added on this Product!'
        );
    }

    public function UpdateComment(array $inputs, object $comment)
    {
        return app(ServiceWrapper::class)(fn() => $comment->update($inputs), 'Comment Updated!');
    }

    public function DeleteComment(object $comment)
    {
        return app(ServiceWrapper::class)(fn() => $comment->delete(), 'comment deleted');
    }
}
