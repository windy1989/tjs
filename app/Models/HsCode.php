<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HsCode extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'hs_codes';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'code',
        'name',
        'alias',
        'status'
    ];

}
