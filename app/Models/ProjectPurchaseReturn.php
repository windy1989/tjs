<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectPurchaseReturn extends Model {

    use HasFactory;

    protected $table      = 'project_purchase_returns';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'product_id',
        'qty',
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

}
