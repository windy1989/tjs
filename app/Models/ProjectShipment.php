<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectShipment extends Model {

    use HasFactory;

    protected $table      = 'project_shipments';
    protected $primaryKey = 'id';
    protected $fillable   = [
		'id',
        'project_id',
		'project_purchase_id',
		'shipment_code',
        'loading_date',
        'departure_date',
        'from_port',
        'to_port',
        'eta',
        'note'
    ];
	
	public function projectPurchase()
    {
        return $this->belongsTo('App\Models\ProjectPurchase', 'project_purchase_id', 'id');
    }
	
	public function projectShipmentProduct()
    {
        return $this->hasMany('App\Models\ProjectShipmentProduct');
    }
	
	public function projectShipmentTrack()
    {
        return $this->hasMany('App\Models\ProjectShipmentTrack');
    }
	
	public function projectShipmentWarehouse()
    {
        return $this->hasMany('App\Models\ProjectWarehouse');
    }
}
