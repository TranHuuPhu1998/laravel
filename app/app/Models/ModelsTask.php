<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsTask extends Model
{   
    protected $table = "task";
    protected $fillable = [
        'title',
        'description',
        'content',
        'status',
        'updated_at',
        'created_at'
    ];
}
