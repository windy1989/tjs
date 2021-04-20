<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model {

    use HasFactory;

    protected $table      = 'customers';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'photo',
        'name',
        'email',
        'phone',
        'password',
        'verification'
    ];

}
