<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'products';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'type_id',
        'company_id',
        'hs_code_id',
        'brand_id',
        'country_id',
        'supplier_id',
        'grade_id',
        'carton_pallet',
        'carton_pcs',
        'container_standart',
        'container_stock',
        'container_max_stock',
        'description',
        'status'
    ];

    public function code()
    {
        $company_code = $this->company->code;
        $brand_code   = $this->brand->code;
        $country_code = $this->country->code;
        $type_code    = $this->type->code;
        $grade_code   = $this->grade->code;

        return $company_code . $brand_code . $country_code . $type_code . $grade_code;
    }

    public function status() 
    {
        switch($this->status) {
            case '1':
                $status = '<span class="text-success font-weight-bold">Active</span>';
                break;
            case '2':
                $status = '<span class="text-danger font-weight-bold">Not Active</span>';
                break;
            default:
                $status = '<span class="text-warning font-weight-bold">Invalid</span>';
                break;
        }

        return $status;
    }

    public function containerStandart() 
    {
        switch($this->container_standart) {
            case '1':
                $container_standart = '20 Feet';
                break;
            case '2':
                $container_standart = '40 Feet';
                break;
            default:
                $container_standart = 'Invalid';
                break;
        }

        return $container_standart;
    }

    public function price()
    {
        $data = $this->currencyPrice->last();
        if($data) {
            if($data->currency->code == 'IDR' || $data->currency->id == 5) {
                $price = $data->price;
            }
        } else {
            $price = 0;
        }

        return $price;
    }

    public function availability()
    {
        $data  = $this->productShading;
        $stock = 0;

        if($data) {
            $stock = $data->sum('qty');
        }

        if($stock > 18) {
            $color  = 'badge-success';
            $status = 'Ready';
        } else if($stock > 2 && $stock <= 18) {
            $color  = 'badge-warning';
            $status = 'Limited';
        } else if($stock > 0 && $stock <= 2) {
            $color  = 'badge-secondary';
            $status = 'Indent';
        } else {
            $color  = 'badge-danger';
            $status = 'Not Available';
        }

        return (object)[
            'color'  => $color,
            'status' => $status,
            'stock'  => $stock
        ];
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function hsCode()
    {
        return $this->belongsTo('App\Models\HsCode');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function productShading()
    {
        return $this->hasMany('App\Models\ProductShading');
    }

    public function currencyPrice()
    {
        return $this->hasMany('App\Models\CurrencyPrice');
    }

    public function currencyRate()
    {
        return $this->hasMany('App\Models\CurrencyRate');
    }

}
