<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'suppliers';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'country_id',
        'code',
        'name',
        'email',
        'phone',
        'address',
        'pic',
        'limit_credit',
        'term_of_payment',
        'status'
    ];

}
