<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model {

    use HasFactory;

    protected $table      = 'stocks';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'warehouse_code',
        'code',
        'type',
        'name',
        'stock'
    ];

}
