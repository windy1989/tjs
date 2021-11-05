<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSaleProduct extends Model {

    use HasFactory;

    protected $table      = 'project_sale_products';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_sale_id',
        'product_id',
		'area',
		'spec',
        'qty',
        'cogs',
        'price',
        'recommended_price',
		'best_price',
        'discount',
        'unit'
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
	
	public function projectSale()
    {
        return $this->belongsTo('App\Models\ProjectSale','project_sale_id', 'id');
    }
}