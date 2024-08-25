<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentDeleteRequest;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(private CommentService $commentService)
    {
    }


    public function store(CommentStoreRequest $request, $product_id)
    {
        $result = $this->commentService->CreateComment($request->validated(), $product_id);
        return $result;
    }


    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $result = $this->commentService->UpdateComment($request->validated(), $comment);
        return $result;
    }


    public function destroy(CommentDeleteRequest $request, Comment $comment)
    {
        $result = $this->commentService->DeleteComment($comment);
        return $result;
    }
}
