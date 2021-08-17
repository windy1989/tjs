<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProduction extends Model {

    use HasFactory;

    protected $table      = 'project_productions';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'image',
        'start_date',
        'finish_date',
        'note'
    ];

}
