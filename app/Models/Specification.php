<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specification extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'specifications';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'code',
        'name',
        'status'
    ];

}
