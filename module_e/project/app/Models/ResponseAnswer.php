<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseAnswer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_response_id',
        'question_id',
        'answer_id',
    ];
}
