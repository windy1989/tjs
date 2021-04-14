<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cogs extends Model {

    protected $table      = 'cogs';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'product_id',
        'currency_id',
        'city_id',
        'import_id',
        'price_profile_custom',
        'agent_fee_usd',
        'shipping',
        'ls_cost_document',
        'number_container',
        'sni_cost'
    ];

    public function shipping() 
    {
        switch($this->shipping) {
            case '1':
                $shipping = 'FOB';
                break;
            case '2':
                $shipping = 'EXWORK';
                break;
            default:
                $shipping = 'Invalid';
                break;
        }

        return $shipping;
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

}
