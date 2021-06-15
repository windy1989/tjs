<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'deliveries';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'vendor_id',
        'transport_id',
        'origin',
        'destination',
        'capacity',
        'price_per_kg',
        'price_per_meter'
    ];

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor');
    }

    public function transport()
    {
        return $this->belongsTo('App\Models\Transport');
    }

    public function origins()
    {
        return $this->belongsTo('App\Models\City', 'origin');
    }

    public function destinations()
    {
        return $this->belongsTo('App\Models\City', 'destination');
    }

}
