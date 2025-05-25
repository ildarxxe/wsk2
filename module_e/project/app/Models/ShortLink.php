<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'poll_id',
        'short_code'
    ];

    public function userResponses(): void
    {
        $this->hasMany(UserResponse::class);
    }
}
