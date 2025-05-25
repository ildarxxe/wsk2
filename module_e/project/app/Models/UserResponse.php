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
        'completed_at',
        'short_link_id'
    ];
}
