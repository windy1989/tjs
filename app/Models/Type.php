<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'types';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'category_id',
        'company_id',
        'division_id',
        'surface_id',
        'color_id',
        'pattern_id',
        'specification_id',
        'buy_unit_id',
        'stock_unit_id',
        'selling_unit_id',
        'image',
        'code',
        'quality',
        'faces',
        'length',
        'width',
        'height',
        'weight',
        'thickness',
        'price',
        'stockable',
        'min_stock',
        'max_stock',
        'small_stock',
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

    public function quality() {
        switch($this->quality) {
            case '1':
                $quality = 'Import';
                break;
            case '2':
                $quality = 'Local';
                break;
            default:
                $quality = 'Invalid';
                break;
        }

        return $quality;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
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

    public function specification()
    {
        return $this->belongsTo('App\Models\Specification');
    }

    public function buyUnit()
    {
        return $this->belongsTo('App\Models\Unit', 'buy_unit_id', 'id');
    }

    public function stockUnit()
    {
        return $this->belongsTo('App\Models\Unit', 'stock_unit_id', 'id');
    }

    public function sellingkUnit()
    {
        return $this->belongsTo('App\Models\Unit', 'selling_unit_id', 'id');
    }

}
