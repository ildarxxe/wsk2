<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'x',
        'y',
        'type',
        'image_path',
        'open_time',
        'close_time',
        'description',
    ];
}
