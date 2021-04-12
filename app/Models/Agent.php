<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'agents';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'country_id',
        'category_id',
        'min_price',
        'max_price',
        'fee'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
