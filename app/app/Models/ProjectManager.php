<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectManager extends Model
{
    protected $table = "ProjectManager";
    protected $fillable = [
        'project_name',
        'project_type',
        'project_client',
        'project_status',
        'date_start',
        'date_end'
    ];
}
