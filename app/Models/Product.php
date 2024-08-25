<?php

namespace App\Models;

use App\Base\Traits\HasRules;
use App\Base\Traits\ProductTraits\ProductUuidGenerator;
use App\Base\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory, HasRules, UuidGenerator;

    protected $fillable = [
        'category_id',
        'user_id',
        'category_name',
        'title',
        'desc',
        'price',
        'image',
        'rate',
    ];

    public static function rules(array $updated_rules = [])
    {
        $base_rules = [
            'title' => ['required', 'string' , 'max:70'],
            'category_name' => ['required', 'string'],
            'desc' => ['nullable' , 'string' , 'min:3', 'max:255'],
            'price' => ['required', 'integer'],
            'image' => ['nullable', 'image'],
            'rate' => ['nullable', 'integer'],
        ];
        $result = array_merge($base_rules, $updated_rules);
        return $result;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    */

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
