<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transport extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'transports';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'transport_type_id',
        'plat_number',
        'fleet'
    ];

    public function transportType() 
    {
        return $this->belongsTo('App\Models\TransportType');
    }

}
