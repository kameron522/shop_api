<?php

namespace App\Models;

use App\Base\Traits\HasRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, HasRules;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'text',
        'image',
    ];

    public static function rules(array $updated_rules = [])
    {
        $base_rules = [
            'text' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
        ];
        $result = array_merge($base_rules, $updated_rules);
        return $result;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
