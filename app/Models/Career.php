<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model {

    use HasFactory;

    protected $table      = 'careers';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'title',
        'description',
        'requirements',
        'deadline'
    ];

}
