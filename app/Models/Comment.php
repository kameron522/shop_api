<?php

namespace App\Models;

use App\Base\Traits\CommentTraits\CommentUuidGenerator;
use App\Base\Traits\HasRules;
use App\Base\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, HasRules, UuidGenerator;

    protected $fillable = [
        'product_id',
        'user_id',
        'text',
        'like',
    ];


    public static function rules()
    {
        return [
            'text' => ['required', 'string'],
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
