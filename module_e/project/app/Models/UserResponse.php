<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_agent',
        'ip_address',
        'short_link_id',
        'completed_at',
    ];
}
