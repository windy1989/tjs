<?php

namespace App\Models;

use App\Models\Emkl;
use App\Models\Freight;
use App\Models\CurrencyRate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cogs extends Model {

    use HasFactory;
    
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

    public function formula() 
    {
        $currency_rate = CurrencyRate::where('currency_id', $this->product->currency_id)
            ->where('company_id', $this->product->company_id)
            ->latest()
            ->limit(1)
            ->get();

        $emkl = Emkl::where('company_id', $this->product->company_id)
            ->where('country_id', $this->product->country_id)
            ->where('container', $this->product->container_standart)
            ->first();

        if($emkl) {
            $container = $emkl->container; 
            $c         = $emkl->container();
            $lcc       = $emkl->cost;
            $cs        = $emkl->container == 1 ? 20 : 40;
        } else {
            $container = 0;
            $c         = 'Not Set';
            $lcc       = 0;
            $cs        = 0;
        }

        $freight = Freight::where('country_id', $this->product->country_id)
            ->where('container', $container)
            ->where('shipping', $this->shipping)
            ->where('city_id', $this->city_id)
            ->first();

        if($this->product->currencyPrice->count() > 0) {
            $pp = $this->product->currencyPrice->last()->price;
        } else {
            $pp = 0;
        }

        if($currency_rate->count() > 0) {
            $ru = $currency_rate[0]->conversion;
        } else {
            $ru = 0;
        }

        if($freight) {
            $fcu = $freight->cost;
        } else {
            $fcu = 0;
        }
        
        $aou  = $this->agent_fee_usd;
        $lcd  = $this->ls_cost_document;
        $nc   = $this->number_container;
        $ppc  = $this->price_profile_custom;
        $sc   = $this->sni_cost;
        $sg   = $ppc * $ru * 0.19;
        $l    = $this->product->type->length ? $this->product->type->length : 0;
        $wd   = $this->product->type->width ? $this->product->type->width : 0;
        $cp   = $this->product->carton_pcs ? $this->product->carton_pcs : 0;
        $t    = $this->product->type->thickness ? $this->product->type->thickness : 0;
        $wg   = $this->product->type->weight;
        $cu   = $this->product->type->conversion;
        $lpi  = $ru * $cu * $pp;
        $tsl  = ($l / 100) * ($wd / 100) * $cp * $cs;
        $afus = @($aou  / $tsl);
        $afi  = @($afus * $cu * $ru);
        $cc   = ($l / 100) * ($wd / 100) * ($t / 1000) * $cp;
        $twc  = $wg * $cs;
        $toc  = $wg * $twc;
        $sd   = ($l / 100) * ($wd / 100) * $cp;
        $fc   = @($fcu * $ru * $toc / $sd);
        $tlc  = @($lcc * $toc / $sd);
        $lcs  = @($lcd * $ru * $toc / $sd / $nc);
        $id   = ($ppc * 0.05) * $ru;
        $vt   = ((($ppc * 0.05) + $ppc) * 0.1) * $ru;
        $it   = ((($ppc * 0.05) + $ppc) * 0.75) * $ru;
        $tit  = $vt + $id + $it;
        $ci   = $lpi + $afi + $fc + $tlc + $lcd + $tit + $sc + $sg;
        $cpi  = $ci * 1.1;
        $csi  = $ci * 1.15;

        return (object)[
            'lengths'                => $l,
            'width'                  => $wd,
            'pcs_ctn'                => $cp,
            'thickness'              => $t,
            'min_total_dos'          => $cs,
            'container'              => $c,
            'product_price'          => !is_nan($pp) && !is_infinite($pp) ? round($pp) : 0,
            'conversion_unit'        => !is_nan($cu) && !is_infinite($cu) ? round($cu) : 0,
            'rate_unit'              => !is_nan($ru) && !is_infinite($ru) ? round($ru) : 0,
            'local_price_idr'        => !is_nan($lpi) ? round($lpi) : 0,
            'total_sqm_load'         => !is_nan($tsl) && !is_infinite($tsl) ? round($tsl) : 0,
            'agent_fee_usd_sqm'      => !is_nan($afus) && !is_infinite($afus) ? round($afus) : 0,
            'agent_fee_idr'          => !is_nan($afi) && !is_infinite($afi) ? round($afi) : 0,
            'freight_cost_usd'       => !is_nan($fcu) && !is_infinite($fcu) ? round($fcu) : 0,
            'cbm_container'          => !is_nan($cc) && !is_infinite($cc) ? round($cc) : 0,
            'kg_dos'                 => $wg,
            'total_weight_container' => !is_nan($twc) && !is_infinite($twc) ? round($twc) : 0,
            'tonnage_of_container'   => !is_nan($toc) && !is_infinite($toc) ? round($toc) : 0,
            'sqm_dos'                => !is_nan($sd) && !is_infinite($sd) ? round($sd) : 0,
            'freight_cost'           => !is_nan($fc) && !is_infinite($fc) ? round($fc) : 0,
            'landed_cost_container'  => !is_nan($lcc) && !is_infinite($lcc) ? round($lcc) : 0,
            'total_landed_cost'      => !is_nan($tlc) && !is_infinite($tlc) ? round($tlc) : 0,
            'rate_of_usd'            => !is_nan($ru) && !is_infinite($ru) ? round($ru) : 0,
            'ls_cost_sqm'            => !is_nan($lcs) && !is_infinite($lcs) ? round($lcs) : 0,
            'import_duty'            => !is_nan($id) && !is_infinite($id) ? round($id) : 0,
            'value_tax'              => !is_nan($vt) && !is_infinite($vt) ? round($vt) : 0,
            'income_tax'             => !is_nan($it) && !is_infinite($it) ? round($it) : 0,
            'total_import_tax'       => !is_nan($tit) && !is_infinite($tit) ? round($tit) : 0,
            'safe_guard'             => !is_nan($sg) && !is_infinite($sg) ? round($sg) : 0,
            'cogs_idr'               => !is_nan($ci) && !is_infinite($ci) ? round($ci) : 0,
            'cogs_pta_idr'           => !is_nan($cpi) && !is_infinite($cpi) ? round($cpi) : 0,
            'cogs_smb_idr'           => !is_nan($csi) && !is_infinite($csi) ? round($csi) : 0
        ];
    }

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

    public function import()
    {
        return $this->belongsTo('App\Models\Import');
    }

}
