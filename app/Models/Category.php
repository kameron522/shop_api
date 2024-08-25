<?php

namespace App\Models;

use App\Base\Traits\FinalValidation;
use App\Base\Traits\HasRules;
use App\Base\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasRules, HasFactory, FinalValidation, UuidGenerator;

    protected $fillable = [
        'name',
        'image',
    ];

    public static function rules()
    {
        return [
            'name' => ['required', 'string', Rule::unique('categories', 'name')],
            'image' => ['required', 'image'],
        ];
    }

    /*
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    */
}
