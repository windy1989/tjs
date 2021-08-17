<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDelivery extends Model {

    use HasFactory;

    protected $table      = 'project_deliveries';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'city_id',
        'delivery_id',
        'receiver_name',
        'delivery_date',
        'email',
        'phone',
        'address',
        'price'
    ];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function delivery()
    {
        return $this->belongsTo('App\Models\Delivery');
    }

}
