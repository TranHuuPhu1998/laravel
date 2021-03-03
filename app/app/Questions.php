<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = "questions";
    protected $fillable = 
    [ 
    'answers_id',
    'question',
    'category'
    ];
}