<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model {
    
    use HasFactory, SoftDeletes;

    protected $table      = 'banners';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'image',
        'title',
        'status'
    ];

}
