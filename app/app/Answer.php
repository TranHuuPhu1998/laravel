<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answer";
    protected $fillable = 
    [ 
        'answers_id',
        'content',
        'isCorrect'
    ];
}
