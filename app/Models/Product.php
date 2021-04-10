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
        'hs_code_id',
        'brand_id',
        'country_id',
        'supplier_id',
        'grade_id',
        'carton_pallet',
        'carton_pcs',
        'carton_sqm',
        'selling_unit',
        'cubic_stock',
        'container_standart',
        'container_stock',
        'container_max_stock',
        'description',
        'status'
    ];

    public function status() {
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

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
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

}
