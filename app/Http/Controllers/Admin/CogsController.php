<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Cogs;
use App\Models\Emkl;
use App\Models\Import;
use App\Models\Freight;
use App\Models\Product;
use App\Models\Currency;
use App\Models\CurrencyRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CogsController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Price Cogs',
            'content' => 'admin.price.cogs'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'product_id',
            'currency_id',
            'city_id',
            'shipping'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Cogs::count();
        
        $query_data = Cogs::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('product', function($query) use ($search) {
                                $query->whereHas('type', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%");
                                    })
                                    ->orWhereHas('company', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%")
                                            ->orWhere('name', 'like', "%$search%");
                                    })
                                    ->orWhereHas('brand', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%")
                                            ->orWhere('name', 'like', "%$search%");
                                    })
                                    ->orWhereHas('country', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%")
                                            ->orWhere('name', 'like', "%$search%");
                                    })
                                    ->orWhereHas('grade', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%")
                                            ->orWhere('name', 'like', "%$search%");
                                    });
                            })
                            ->orWhereHas('currency', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
                            })
                            ->orWhereHas('city', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }         

                if($request->status) {
                    $query->where('status', $request->status);
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Cogs::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('product', function($query) use ($search) {
                                $query->whereHas('type', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%");
                                    })
                                    ->orWhereHas('company', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%")
                                            ->orWhere('name', 'like', "%$search%");
                                    })
                                    ->orWhereHas('brand', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%")
                                            ->orWhere('name', 'like', "%$search%");
                                    })
                                    ->orWhereHas('country', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%")
                                            ->orWhere('name', 'like', "%$search%");
                                    })
                                    ->orWhereHas('grade', function($query) use ($search) {
                                        $query->whereRaw('INSTR(?, code)', [$search])
                                            ->orWhere('code', 'like', "%$search%")
                                            ->orWhere('name', 'like', "%$search%");
                                    });
                            })
                            ->orWhereHas('currency', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
                            })
                            ->orWhereHas('city', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }         

                if($request->status) {
                    $query->where('status', $request->status);
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $response['data'][] = [
                    $nomor,
                    $val->product->code(),
                    $val->currency->code,
                    $val->city->name,
                    $val->shipping(),
                    '
                        <button type="button" class="btn bg-info btn-sm" data-popup="tooltip" title="Info" onclick="show(' . $val->id . ')"><i class="icon-info22"></i></button>
                    '
                ];

                $nomor++;
            }
        }

        $response['recordsTotal'] = 0;
        if($total_data <> FALSE) {
            $response['recordsTotal'] = $total_data;
        }

        $response['recordsFiltered'] = 0;
        if($total_filtered <> FALSE) {
            $response['recordsFiltered'] = $total_filtered;
        }

        return response()->json($response);
    }

    public function getCompleteData(Request $request)
    {
        $data          = Product::find($request->product_id);
        $currency_rate = CurrencyRate::where('currency_id', $request->currency_id)
            ->where('company_id', $data->company_id)
            ->latest()
            ->limit(1)
            ->get();

        $emkl = Emkl::where('company_id', $data->company_id)
            ->where('country_id', $data->country_id)
            ->where('container', $data->container_standart)
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

        $freight = Freight::where('country_id', $data->country_id)
            ->where('container', $container)
            ->where('shipping', $request->shipping)
            ->where('city_id', $request->city_id)
            ->first();

        if($data->currencyPrice) {
            $pp = $data->currencyPrice->price;
        } else {
            $pp = 0;
        }

        if($currency_rate->count() > 0) {
            $symbol = $currency_rate[0]->currency->symbol;
            $ru     = $currency_rate[0]->conversion;
        } else {
            $symbol = null;
            $ru     = 0;
        }

        if($freight) {
            $fcu = $freight->cost;
        } else {
            $fcu = 0;
        }
        
        $aou  = $request->agent_fee_usd ? $request->agent_fee_usd : 0;
        $lcd  = $request->ls_cost_document ? $request->ls_cost_document : 0;
        $nc   = $request->number_container ? $request->number_container : 0;
        $ppc  = $request->price_profile_custom ? $request->price_profile_custom : 0;
        $sc   = $request->sni_cost ? $request->sni_cost : 0;
        $sg   = 11776;
        $l    = $data->type->length ? $data->type->length : 0;
        $wd   = $data->type->width ? $data->type->width : 0;
        $cp   = $data->type->carton_pcs ? $data->type->carton_pcs : 0;
        $t    = $data->type->thickness ? $data->type->thickness : 0;
        $wg   = $data->type->weight;
        $cu   = $data->type->conversion;
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
        $it   = ((($ppc * 0.05) + $ppc) * 0.075) * $ru;
        $tit  = $vt + $id + $it;
        $ci   = $lpi + $afi + $fc + $tlc + $lcd + $tit + $sc + $sg;
        $cpi  = $ci * 1.1;
        $csi  = $ci * 1.15;

        return response()->json([
            'origin_country'         => $data->country->name,
            'lengths'                => number_format($l, 0, ',', '.') . ' Cm',
            'width'                  => number_format($wd, 0, ',', '.') . ' Cm',
            'pcs_ctn'                => number_format($cp, 0, ',', '.') . ' <sub>/ CARTON</sub>',
            'thickness'              => number_format($t, 0, ',', '.') . ' mm',
            'min_total_dos'          => number_format($cs, 0, ',', '.') . ' mm <sub>/ CONTAINER</sub>',
            'container'              => $c,
            'product_price'          => $symbol . (!is_nan($pp) && !is_infinite($pp) ? number_format($pp, 0, ',', '.') : 0),
            'buying_unit'            => $data->type->buyUnit->code,
            'selling_unit'           => $data->type->sellingUnit->code,
            'conversion_unit'        => $symbol . (!is_nan($cu) && !is_infinite($cu) ? number_format($cu, 0, ',', '.') : 0),
            'rate_unit'              => $symbol . (!is_nan($ru) && !is_infinite($ru) ? number_format($ru, 0, ',', '.') : 0),
            'local_price_idr'        => $symbol . (!is_nan($lpi) && !is_infinite($lpi) ? number_format($lpi, 0, ',', '.') : 0),
            'total_sqm_load'         => (!is_nan($tsl) && !is_infinite($tsl) ? number_format(round($tsl), 0, ',', '.') : 0) . ' <sub>/ CONTAINER</sub>',
            'agent_fee_usd_sqm'      => (!is_nan($afus) && !is_infinite($afus) ? number_format($afus, 3, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'agent_fee_idr'          => $symbol . (!is_nan($afi) && !is_infinite($afi) ? number_format($afi, 0, ',', '.') : 0),
            'freight_cost_usd'       => $symbol . (!is_nan($fcu) && !is_infinite($fcu) ? number_format($fcu, 0, ',', '.') : 0) . ' <sub>/ CONTAINER</sub>',
            'cbm_container'          => (!is_nan($cc) && !is_infinite($cc) ? number_format(round($cc), 0, ',', '.') : 0) . ' <sub>/ CONTAINER</sub>',
            'kg_dos'                 => number_format($wg, 0, ',', '.') . ' Kg',
            'total_weight_container' => (!is_nan($twc) && !is_infinite($twc) ? number_format(round($twc), 0, ',', '.') : 0) . ' <sub>/ CONTAINER</sub>',
            'tonnage_of_container'   => (!is_nan($toc) && !is_infinite($toc) ? number_format(round($toc), 0, ',', '.') : 0) . '%',
            'sqm_dos'                => (!is_nan($sd) && !is_infinite($sd) ? number_format(round($sd), 0, ',', '.') : 0) . ' <sub>/ DOS</sub>',
            'freight_cost'           => $symbol . (!is_nan($fc) && !is_infinite($fc) ? number_format(round($fc), 0, ',', '.') : 0),
            'landed_cost_container'  => $symbol . (!is_nan($lcc) && !is_infinite($lcc) ? number_format($lcc, 0, ',', '.') : 0) . ' <sub>/ CONTAINER</sub>',
            'total_landed_cost'      => $symbol . (!is_nan($tlc) && !is_infinite($tlc) ? number_format(round($tlc), 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'rate_of_usd'            => $symbol . (!is_nan($ru) && !is_infinite($ru) ? number_format($ru, 0, ',', '.') : 0),
            'ls_cost_sqm'            => $symbol . (!is_nan($lcs) && !is_infinite($lcs) ? number_format(round($lcs), 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'import_duty'            => $symbol . (!is_nan($id) && !is_infinite($id) ? number_format(round($id), 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'value_tax'              => $symbol . (!is_nan($vt) && !is_infinite($vt) ? number_format(round($vt), 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'income_tax'             => $symbol . (!is_nan($it) && !is_infinite($it) ? number_format(round($it), 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'total_import_tax'       => $symbol . (!is_nan($tit) && !is_infinite($tit) ? number_format(round($tit), 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'safe_guard'             => $symbol . (!is_nan($sg) && !is_infinite($sg) ? number_format($sg, 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'cogs_idr'               => $symbol . (!is_nan($ci) && !is_infinite($ci) ? number_format($ci, 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'cogs_pta_idr'           => $symbol . (!is_nan($cpi) && !is_infinite($cpi) ? number_format($cpi, 0, ',', '.') : 0) . ' <sub>/ SQM</sub>',
            'cogs_smb_idr'           => $symbol . (!is_nan($csi) && !is_infinite($csi) ? number_format($csi, 0, ',', '.') : 0) . ' <sub>/ SQM</sub>'
        ]);
    }

    public function create(Request $request)
    {
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'product_id'           => 'required',
                'currency_id'          => 'required',
                'city_id'              => 'required',
                'import_id'            => 'required',
                'price_profile_custom' => 'required',
                'agent_fee_usd'        => 'required',
                'shipping'             => 'required',
                'ls_cost_document'     => 'required',
                'number_container'     => 'required',
                'sni_cost'             => 'required'
            ], [
                'product_id.required'           => 'Please select a product.',
                'currency_id.required'          => 'Please select a unit currency.',
                'city_id.required'              => 'Please select a destination port.',
                'import_id.required'            => 'Please select a import.',
                'shipping.required'             => 'Please select a shipping.',
                'price_profile_custom.required' => 'Price profile custom cannot be empty.',
                'agent_fee_usd.required'        => 'Agent fee cannot be empty.',
                'ls_cost_document.required'     => 'ls cost document cannot be empty.',
                'container_stock.required'      => 'Container stock cannot be empty.',
                'number_container.required'     => 'Number container cannot be empty.',
                'sni_cost.required'             => 'SNI cost cannot be empty.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query = Cogs::create([
                    'product_id'           => $request->product_id,
                    'currency_id'          => $request->currency_id,
                    'city_id'              => $request->city_id,
                    'import_id'            => $request->import_id,
                    'price_profile_custom' => $request->price_profile_custom,
                    'agent_fee_usd'        => $request->agent_fee_usd,
                    'shipping'             => $request->shipping,
                    'ls_cost_document'     => $request->ls_cost_document,
                    'number_container'     => $request->number_container,
                    'sni_cost'             => $request->sni_cost
                ]);

                if($query) {
                    activity()
                        ->performedOn(new Cogs())
                        ->causedBy(session('bo_id'))
                        ->withProperties($query)
                        ->log('Add price cogs data');

                    return redirect()->back()->with(['success' => 'Data added successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to added.']);
                }
            }
        } else {
            $data = [
                'title'    => 'Create New Price Cogs',
                'currency' => Currency::where('status', 1)->get(),
                'city'     => City::all(),
                'import'   => Import::all(),
                'content'  => 'admin.price.cogs_create'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function show(Request $request)
    {
        $data     = Cogs::find($request->id);
        $formula  = $data->formula();
        $currency = $data->currency->code;
        $symbol   = $data->currency->symbol;

        return response()->json([
            'product'                => $data->product->code(),
            'currency'               => $currency,
            'city'                   => $data->city->name,
            'import'                 => $data->import->name,
            'price_profile_custom'   => $symbol . number_format($data->price_profile_custom, 0, ',', '.'),
            'agent_fee_usd'          => $symbol . number_format($data->agent_fee_usd, 0, ',', '.'),
            'shipping'               => $data->shipping(),
            'ls_cost_document'       => $symbol . number_format($data->ls_cost_document, 0, ',', '.'),
            'number_container'       => $data->number_container,
            'sni_cost'               => $symbol . number_format($data->sni_cost, 0, ',', '.'),
            'origin_country'         => $data->product->country->name,
            'lengths'                => number_format($formula->lengths, 0, ',', '.') . ' Cm',
            'width'                  => number_format($formula->width, 0, ',', '.') . ' Cm',
            'pcs_ctn'                => number_format($formula->pcs_ctn, 0, ',', '.') . ' <sub>/ CARTON</sub>',
            'thickness'              => number_format($formula->thickness, 0, ',', '.') . ' mm',
            'min_total_dos'          => number_format($formula->min_total_dos, 0, ',', '.') . ' mm <sub>/ CONTAINER</sub>',
            'container'              => $formula->container,
            'product_price'          => $symbol . number_format($formula->product_price, 0, ',', '.'),
            'buying_unit'            => $data->product->type->buyUnit->code,
            'selling_unit'           => $data->product->type->sellingUnit->code,
            'conversion_unit'        => $symbol . number_format($formula->conversion_unit, 0, ',', '.'),
            'rate_unit'              => $symbol . number_format($formula->rate_unit, 0, ',', '.'),
            'local_price_idr'        => $symbol . number_format($formula->local_price_idr, 0, ',', '.'),
            'total_sqm_load'         => number_format($formula->total_sqm_load, 0, ',', '.') . ' <sub>/ CONTAINER</sub>',
            'agent_fee_usd_sqm'      => number_format($formula->agent_fee_usd_sqm, 3, ',', '.') . ' <sub>/ SQM</sub>',
            'agent_fee_idr'          => $symbol . number_format($formula->agent_fee_idr, 0, ',', '.'),
            'freight_cost_usd'       => $symbol . number_format($formula->freight_cost_usd, 0, ',', '.') . ' <sub>/ CONTAINER</sub>',
            'cbm_container'          => number_format($formula->cbm_container, 0, ',', '.') . ' <sub>/ CONTAINER</sub>',
            'kg_dos'                 => number_format($formula->kg_dos, 0, ',', '.') . ' Kg',
            'total_weight_container' => number_format($formula->total_weight_container, 0, ',', '.') . ' <sub>/ CONTAINER</sub>',
            'tonnage_of_container'   => number_format($formula->tonnage_of_container, 0, ',', '.') . '%',
            'sqm_dos'                => number_format($formula->sqm_dos, 0, ',', '.') . ' <sub>/ DOS</sub>',
            'freight_cost'           => $symbol . number_format($formula->freight_cost, 0, ',', '.'),
            'landed_cost_container'  => $symbol . number_format($formula->landed_cost_container, 0, ',', '.') . ' <sub>/ CONTAINER</sub>',
            'total_landed_cost'      => $symbol . number_format($formula->total_landed_cost, 0, ',', '.') . ' <sub>/ SQM</sub>',
            'rate_of_usd'            => $symbol . number_format($formula->rate_of_usd, 0, ',', '.'),
            'ls_cost_sqm'            => $symbol . number_format($formula->ls_cost_sqm, 0, ',', '.') . ' <sub>/ SQM</sub>',
            'import_duty'            => $symbol . number_format($formula->import_duty, 0, ',', '.') . ' <sub>/ SQM</sub>',
            'value_tax'              => $symbol . number_format($formula->value_tax, 0, ',', '.') . ' <sub>/ SQM</sub>',
            'income_tax'             => $symbol . number_format($formula->income_tax, 0, ',', '.') . ' <sub>/ SQM</sub>',
            'total_import_tax'       => $symbol . number_format($formula->total_import_tax, 0, ',', '.') . ' <sub>/ SQM</sub>',
            'safe_guard'             => $symbol . number_format($formula->safe_guard, 0, ',', '.') . ' <sub>/ SQM</sub>',
            'cogs_idr'               => $symbol . number_format($formula->cogs_idr, 0, ',', '.') . ' <sub>/ SQM</sub>',
            'cogs_pta_idr'           => $symbol . number_format($formula->cogs_pta_idr, 0, ',', '.')  . ' <sub>/ SQM</sub>',
            'cogs_smb_idr'           => $symbol . number_format($formula->cogs_smb_idr, 0, ',', '.') . ' <sub>/ SQM</sub>'
        ]);
    }

}
