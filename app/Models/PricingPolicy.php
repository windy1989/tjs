<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingPolicy extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'pricing_policies';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'product_id',
        'cogs',
        'showroom_cost',
        'sales_travel_cost',
        'marketing_cost',
        'interest',
        'sales_commission',
        'fixed_cost',
        'nett_profit',
        'saving',
        'middlemant',
        'project',
        'on_site_cost',
        'storage_cost',
        'bottom_price',
        'project_price',
        'price_list',
        'store_price_list',
        'discount_retail_sales',
        'discount_retail_manager',
        'discount_retail_director'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
