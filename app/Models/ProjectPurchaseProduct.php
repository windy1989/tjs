<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPurchaseProduct extends Model {

    use HasFactory;

    protected $table      = 'project_purchase_products';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_purchase_id',
        'product_id',
        'qty',
		'unit',
        'price',
		'remark'
    ];
	
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
