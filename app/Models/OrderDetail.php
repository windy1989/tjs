<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {

    use HasFactory;

    protected $table      = 'order_details';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'order_id',
        'product_id',
        'showroom_cost',
        'marketing_cost',
        'bottom_price',
        'fixed_cost',
        'price_list',
        'target_price',
        'cogs_perwira',
        'cogs_smartmarble',
        'profit',
        'partial_delivery',
        'qty',
        'ready',
        'indent',
        'total'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
