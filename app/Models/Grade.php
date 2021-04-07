<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'grades';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'code',
        'name',
        'status'
    ];

}
