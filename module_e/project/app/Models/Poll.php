<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'category_id',
    ];
}
