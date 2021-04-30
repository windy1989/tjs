<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PricingPolicy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PricingPolicyController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Price Pricing Policy',
            'content' => 'admin.price.pricing_policy'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'detail',
            'id',
            'product_id',
            'showroom_cost',
            'fixed_cost',
            'marketing_cost',
            'price_list'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = PricingPolicy::count();
        
        $query_data = PricingPolicy::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('product', function($query) use ($search) {
                                $query->whereHas('type', function($query) use ($search) {
                                    $query->where('code', 'like', "%$search%");
                                })
                                ->orWhereHas('company', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('code', 'like', "%$search%");
                                })
                                ->orWhereHas('country', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('code', 'like', "%$search%");
                                })
                                ->orWhereHas('brand', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('code', 'like', "%$search%");
                                })
                                ->orWhereHas('grade', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('code', 'like', "%$search%");
                                });
                            });
                    });
                }    
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = PricingPolicy::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('product', function($query) use ($search) {
                                $query->whereHas('type', function($query) use ($search) {
                                    $query->where('code', 'like', "%$search%");
                                })
                                ->orWhereHas('company', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('code', 'like', "%$search%");
                                })
                                ->orWhereHas('country', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('code', 'like', "%$search%");
                                })
                                ->orWhereHas('brand', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('code', 'like', "%$search%");
                                })
                                ->orWhereHas('grade', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('code', 'like', "%$search%");
                                });
                            });
                    });
                }       
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $response['data'][] = [
                    '<span class="pointer-element badge badge-success" data-id="' . $val->id . '"><i class="icon-plus3"></i></span>',
                    $nomor,
                    $val->product->code(),
                    number_format($val->showroom_cost),
                    number_format($val->fixed_cost),
                    number_format($val->marketing_cost),
                    number_format($val->price_list),
                    '
                        <button type="button" class="btn bg-warning btn-sm" title="Edit" onclick="show(' . $val->id . ')"><i class="icon-pencil7"></i></button>
                        <button type="button" class="btn bg-danger btn-sm" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>
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

    public function rowDetail(Request $request)
    {
        $data = PricingPolicy::find($request->id);
        return response()->json([
            'Showroom Cost'           => number_format($data->showroom_cost),
            'Sales Travel Cost'       => number_format($data->sales_travel_cost),
            'Marketing Cost'          => number_format($data->marketing_cost),
            'Interest'                => number_format($data->interest),
            'Sales Commission'        => number_format($data->sales_commission),
            'Fixed Cost'              => number_format($data->fixed_cost),
            'Nett Profit'             => number_format($data->nett_profit),
            'Saving'                  => number_format($data->saving),
            'Middlemant'              => number_format($data->middlemant),
            'Project'                 => number_format($data->project),
            'On Site Cost'            => number_format($data->on_site_cost),
            'Storage Cost'            => number_format($data->storage_cost),
            'Bottom Price'            => number_format($data->bottom_price),
            'Project Price'           => number_format($data->project_price),
            'Price List'              => number_format($data->price_list),
            'Store Price List'        => number_format($data->store_price_list),
            'Discount Retail Sales'   => number_format($data->discount_retail_sales),
            'Discount Retail SPV'     => number_format($data->discount_retail_spv),
            'Discount Retail Manager' => number_format($data->discount_retail_manager)
        ]);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'product_id'              => 'required',
            'showroom_cost'           => 'required',
            'sales_travel_cost'       => 'required',
            'marketing_cost'          => 'required',
            'interest'                => 'required',
            'sales_commission'        => 'required',
            'fixed_cost'              => 'required',
            'nett_profit'             => 'required',
            'saving'                  => 'required',
            'middlemant'              => 'required',
            'project'                 => 'required',
            'on_site_cost'            => 'required',
            'storage_cost'            => 'required',
            'bottom_price'            => 'required',
            'project_price'           => 'required',
            'price_list'              => 'required',
            'store_price_list'        => 'required',
            'discount_retail_sales'   => 'required',
            'discount_retail_spv'     => 'required',
            'discount_retail_manager' => 'required'
        ], [
            'product_id.required'              => 'Please select a product.',
            'showroom_cost.required'           => 'Showroom cost cannot be empty.',
            'sales_travel_cost.required'       => 'Sales travel cost cannot be empty.',
            'marketing_cost.required'          => 'Marketing cost cannot be empty.',
            'interest.required'                => 'Interest cannot be empty.',
            'sales_commission.required'        => 'Sales commission cannot be empty.',
            'fixed_cost.required'              => 'Fixed cost cannot be empty.',
            'nett_profit.required'             => 'Nett profit cannot be empty.',
            'saving.required'                  => 'Saving cannot be empty.',
            'middlemant.required'              => 'Middlemant cannot be empty.',
            'project.required'                 => 'Project cannot be empty.',
            'on_site_cost.required'            => 'On site cost cannot be empty.',
            'storage_cost.required'            => 'Storage cost cannot be empty.',
            'bottom_price.required'            => 'Bottom price cannot be empty.',
            'project_price.required'           => 'Project price cannot be empty.',
            'price_list.required'              => 'Price list cannot be empty.',
            'store_price_list.required'        => 'Store price list cannot be empty.',
            'discount_retail_sales.required'   => 'Discount retail sales cannot be empty.',
            'discount_retail_spv.required'     => 'Discount retail SPV cannot be empty.',
            'discount_retail_manager.required' => 'Discount retail manager cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = PricingPolicy::create([
                'product_id'              => $request->product_id,
                'showroom_cost'           => $request->showroom_cost,
                'sales_travel_cost'       => $request->sales_travel_cost,
                'marketing_cost'          => $request->marketing_cost,
                'interest'                => $request->interest,
                'sales_commission'        => $request->sales_commission,
                'fixed_cost'              => $request->fixed_cost,
                'nett_profit'             => $request->nett_profit,
                'saving'                  => $request->saving,
                'middlemant'              => $request->middlemant,
                'project'                 => $request->project,
                'on_site_cost'            => $request->on_site_cost,
                'storage_cost'            => $request->storage_cost,
                'bottom_price'            => $request->bottom_price,
                'project_price'           => $request->project_price,
                'price_list'              => $request->price_list,
                'store_price_list'        => $request->store_price_list,
                'discount_retail_sales'   => $request->discount_retail_sales,
                'discount_retail_spv'     => $request->discount_retail_spv,
                'discount_retail_manager' => $request->discount_retail_manager
            ]);

            if($query) {
                activity()
                    ->performedOn(new PricingPolicy())
                    ->causedBy(session('bo_id'))
                    ->withProperties($query)
                    ->log('Add price pricing policy data');

                $response = [
                    'status'  => 200,
                    'message' => 'Data added successfully.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data failed to add.'
                ];
            }
        }

        return response()->json($response);
    }

    public function show(Request $request)
    {
        $data = PricingPolicy::find($request->id);
        return response()->json([
            'product_id'              => $data->product_id,
            'product_code'            => $data->product->code(),
            'showroom_cost'           => $data->showroom_cost,
            'sales_travel_cost'       => $data->sales_travel_cost,
            'marketing_cost'          => $data->marketing_cost,
            'interest'                => $data->interest,
            'sales_commission'        => $data->sales_commission,
            'fixed_cost'              => $data->fixed_cost,
            'nett_profit'             => $data->nett_profit,
            'saving'                  => $data->saving,
            'middlemant'              => $data->middlemant,
            'project'                 => $data->project,
            'on_site_cost'            => $data->on_site_cost,
            'storage_cost'            => $data->storage_cost,
            'bottom_price'            => $data->bottom_price,
            'project_price'           => $data->project_price,
            'price_list'              => $data->price_list,
            'store_price_list'        => $data->store_price_list,
            'discount_retail_sales'   => $data->discount_retail_sales,
            'discount_retail_spv'     => $data->discount_retail_spv,
            'discount_retail_manager' => $data->discount_retail_manager
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'product_id'              => 'required',
            'showroom_cost'           => 'required',
            'sales_travel_cost'       => 'required',
            'marketing_cost'          => 'required',
            'interest'                => 'required',
            'sales_commission'        => 'required',
            'fixed_cost'              => 'required',
            'nett_profit'             => 'required',
            'saving'                  => 'required',
            'middlemant'              => 'required',
            'project'                 => 'required',
            'on_site_cost'            => 'required',
            'storage_cost'            => 'required',
            'bottom_price'            => 'required',
            'project_price'           => 'required',
            'price_list'              => 'required',
            'store_price_list'        => 'required',
            'discount_retail_sales'   => 'required',
            'discount_retail_spv'     => 'required',
            'discount_retail_manager' => 'required'
        ], [
            'product_id.required'              => 'Please select a product.',
            'showroom_cost.required'           => 'Showroom cost cannot be empty.',
            'sales_travel_cost.required'       => 'Sales travel cost cannot be empty.',
            'marketing_cost.required'          => 'Marketing cost cannot be empty.',
            'interest.required'                => 'Interest cannot be empty.',
            'sales_commission.required'        => 'Sales commission cannot be empty.',
            'fixed_cost.required'              => 'Fixed cost cannot be empty.',
            'nett_profit.required'             => 'Nett profit cannot be empty.',
            'saving.required'                  => 'Saving cannot be empty.',
            'middlemant.required'              => 'Middlemant cannot be empty.',
            'project.required'                 => 'Project cannot be empty.',
            'on_site_cost.required'            => 'On site cost cannot be empty.',
            'storage_cost.required'            => 'Storage cost cannot be empty.',
            'bottom_price.required'            => 'Bottom price cannot be empty.',
            'project_price.required'           => 'Project price cannot be empty.',
            'price_list.required'              => 'Price list cannot be empty.',
            'store_price_list.required'        => 'Store price list cannot be empty.',
            'discount_retail_sales.required'   => 'Discount retail sales cannot be empty.',
            'discount_retail_spv.required'     => 'Discount retail SPV cannot be empty.',
            'discount_retail_manager.required' => 'Discount retail manager cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = PricingPolicy::where('id', $id)->update([
                'product_id'              => $request->product_id,
                'showroom_cost'           => $request->showroom_cost,
                'sales_travel_cost'       => $request->sales_travel_cost,
                'marketing_cost'          => $request->marketing_cost,
                'interest'                => $request->interest,
                'sales_commission'        => $request->sales_commission,
                'fixed_cost'              => $request->fixed_cost,
                'nett_profit'             => $request->nett_profit,
                'saving'                  => $request->saving,
                'middlemant'              => $request->middlemant,
                'project'                 => $request->project,
                'on_site_cost'            => $request->on_site_cost,
                'storage_cost'            => $request->storage_cost,
                'bottom_price'            => $request->bottom_price,
                'project_price'           => $request->project_price,
                'price_list'              => $request->price_list,
                'store_price_list'        => $request->store_price_list,
                'discount_retail_sales'   => $request->discount_retail_sales,
                'discount_retail_spv'     => $request->discount_retail_spv,
                'discount_retail_manager' => $request->discount_retail_manager
            ]);

            if($query) {
                activity()
                    ->performedOn(new PricingPolicy())
                    ->causedBy(session('bo_id'))
                    ->log('Change the price pricing policy data');

                $response = [
                    'status'  => 200,
                    'message' => 'Data updated successfully.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data failed to update.'
                ];
            }
        }

        return response()->json($response);
    }

    public function destroy(Request $request) 
    {
        $query = PricingPolicy::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new PricingPolicy())
                ->causedBy(session('bo_id'))
                ->log('Delete the price pricing policy data');

            $response = [
                'status'  => 200,
                'message' => 'Data deleted successfully.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Data failed to delete.'
            ];
        }

        return response()->json($response);
    }

}
