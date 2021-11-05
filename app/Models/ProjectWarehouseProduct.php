<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWarehouseProduct extends Model {

    use HasFactory;

    protected $table      = 'project_warehouse_products';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_warehouse_id',
        'product_id',
        'qty',
        'unit',
		'qty_broken',
        'unit_broken'
    ];
	
	public function projectWarehouse()
    {
        return $this->belongsTo('App\Models\ProjectWarehouse', 'project_warehouse_id', 'id');
    }
	
	public function unit()
    {
        switch($this->unit) {
            case '1':
                $unit = 'Pcs';
                break;
            case '2':
                $unit = 'Box';
                break;
            case '3':
                $unit = 'Meter';
                break;
            default:
                $unit = 'Invalid';
                break;
        }

        return $unit;
    }
	
	public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
