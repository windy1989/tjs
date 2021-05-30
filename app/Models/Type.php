<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'types';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'category_id',
        'division_id',
        'surface_id',
        'color_id',
        'pattern_id',
        'loading_limit_id',
        'buy_unit_id',
        'stock_unit_id',
        'selling_unit_id',
        'image',
        'code',
        'material',
        'faces',
        'length',
        'width',
        'height',
        'weight',
        'thickness',
        'conversion',
        'stockable',
        'min_stock',
        'max_stock',
        'small_stock',
        'status'
    ];

    public function image() 
    {
        if(Storage::exists($this->image)) {
            $image = asset(Storage::url($this->image));
        } else {
            $image = asset('website/empty.jpg');
        }

        return $image;
    }

    public function material() 
    {
        switch($this->material) {
            case '1':
                $material = 'Low';
                break;
            case '2':
                $material = 'Medium';
                break;
            case '3':
                $material = 'High';
                break;
            default:
                $material = 'Invalid';
                break;
        }

        return $material;
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

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function surface()
    {
        return $this->belongsTo('App\Models\Surface');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }

    public function pattern()
    {
        return $this->belongsTo('App\Models\Pattern');
    }

    public function loadingLimit()
    {
        return $this->belongsTo('App\Models\LoadingLimit');
    }

    public function buyUnit()
    {
        return $this->belongsTo('App\Models\Unit', 'buy_unit_id', 'id');
    }

    public function stockUnit()
    {
        return $this->belongsTo('App\Models\Unit', 'stock_unit_id', 'id');
    }

    public function sellingUnit()
    {
        return $this->belongsTo('App\Models\Unit', 'selling_unit_id', 'id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

}
