<?php

namespace App\Models;

use App\Base\Traits\HasRules;
use App\Base\Traits\UuidGenerator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasRules, HasApiTokens, UuidGenerator;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function rules(array $updated_data = [])
    {

        $base_validation = [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => ['required', 'string' , 'min:4', 'max:32'],
            'image' => ['nullable', 'image'],
        ];

        $result = array_merge($base_validation, $updated_data);

        return $result;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function otp()
    {
        return $this->hasOne(Otp::class);
    }

    public function reset()  // reset password
    {
        return $this->hasOne(Reset::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
