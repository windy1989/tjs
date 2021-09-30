<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectQuotationProduct extends Model {

    use HasFactory;

    protected $table      = 'project_quotation_products';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_quotation_id',
        'product_id',
        'recommended_price',
        'best_price',
		'discount'
    ];
	
	public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
	
}
