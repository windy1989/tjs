<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surface extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'surfaces';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'code',
        'name',
        'status'
    ];

}
