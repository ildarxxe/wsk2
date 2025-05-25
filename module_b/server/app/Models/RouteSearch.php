<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteSearch extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id',
        'from_place_id',
        'to_place_id',
    ];
}
