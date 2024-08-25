<?php

namespace App\Models;

use App\Base\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, UuidGenerator;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
