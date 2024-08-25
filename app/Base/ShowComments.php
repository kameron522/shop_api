<?php

namespace App\Base;


class ShowComments
{

    public static function product_comments(object $product)
    {
        $product_all_comments = [];

        if (count($product->comments) == 0)
            return "no comments yet";

        foreach($product->comments as $comment)
        {
            $comment = [
                "text" => $comment->text,
                "name" => $comment->user->name,
                "time added" => $comment->updated_at->diffForHumans(),
            ];
            $product_all_comments = array_merge($product_all_comments, [$comment]);
        }

        return $product_all_comments;
    }

}
