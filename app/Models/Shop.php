<?php

namespace App\Models;

use App\Base\Traits\HasRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Shop extends Model
{
    use HasFactory, HasRules;

    protected $fillable = [
        'user_id',
        'brand',
        'image',
        'is_verified',
    ];

    public static function rules(array $upd_rules = [])  // upd_rules is updated rules
    {
        $base_rules = [
            'brand' => ['required', 'string', Rule::unique('shops', 'brand')],
            'image' => ['nullable', 'image'],
            'is_verified' => ['boolean'],
        ];
        $result = array_merge($base_rules, $upd_rules);
        return $result;
    }
}
