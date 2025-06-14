<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'poll_id',
        'question_text',
        'type'
    ];

    public function answers(): void
    {
        $this->hasMany(Answer::class);
    }
}
