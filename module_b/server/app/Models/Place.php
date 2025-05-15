<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'latitude', 'longitude', 'x', 'y', 'image_path', 'open_time', 'close_time', 'description'];
    public $timestamps = false;
}
