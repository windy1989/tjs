<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Import;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CogsController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Product Code',
            'content' => 'admin.product.code'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'type_id',
            'code',
            'brand_id',
            'country_id',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Product::count();
        
        $query_data = Product::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('type', function($query) use ($search) {
                                $query->where('code', 'like', "%$search%");
                            })
                            ->orWhereHas('company', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
                            })
                            ->orWhereHas('brand', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
                            })
                            ->orWhereHas('country', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
                            })
                            ->orWhereHas('grade', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
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

        $total_filtered = Product::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('type', function($query) use ($search) {
                                $query->where('code', 'like', "%$search%");
                            })
                            ->orWhereHas('company', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
                            })
                            ->orWhereHas('brand', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
                            })
                            ->orWhereHas('country', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
                            })
                            ->orWhereHas('grade', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('code', 'like', "%$search%");
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
                    $val->type->code,
                    $val->code(),
                    $val->brand->name,
                    $val->country->name,
                    $val->status(),
                    '
                        <button type="button" class="btn bg-info btn-sm" title="Info" onclick="show(' . $val->id . ')"><i class="icon-info22"></i></button>
                        <a href="' . url('admin/product/code/update/' . $val->id) . '" class="btn bg-warning btn-sm" title="Edit"><i class="icon-pencil7"></i></a>
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

    public function generateCode(Request $request)
    {
        $name    = '';
        $company = Company::find($request->company_id);
        $brand   = Brand::find($request->brand_id);
        $country = Country::find($request->country_id);
        $type    = Type::find($request->type_id);
        $grade   = Grade::find($request->grade_id);

        if($company) {
            $name .= $company->code;
        }
     
        if($brand) {
            $name .= $brand->code;
        }

        if($country) {
            $name .= $country->code;
        }

        if($type) {
            $name .= $type->code;
        }

        if($grade) {
            $name .= $grade->code;
        }

        return response()->json($name);
    }

    public function create(Request $request)
    {
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'type_id'             => 'required',
                'company_id'          => 'required',
                'hs_code_id'          => 'required',
                'brand_id'            => 'required',
                'country_id'          => 'required',
                'supplier_id'         => 'required',
                'grade_id'            => 'required',
                'selling_unit'        => 'required',
                'cubic_meter'         => 'required',
                'container_standart'  => 'required',
                'container_stock'     => 'required',
                'container_max_stock' => 'required',
                'description'         => 'required',
                'status'              => 'required'
            ], [
                'type_id.required'             => 'Please select a type.',
                'company_id.required'          => 'Please select a company.',
                'hs_code_id.required'          => 'Please select a hs code.',
                'brand_id.required'            => 'Please select a brand.',
                'country_id.required'          => 'Please select a country.',
                'supplier_id.required'         => 'Please select a supplier.',
                'grade_id.required'            => 'Please select a grade.',
                'selling_unit.required'        => 'Selling unit cannot be empty.',
                'cubic_meter.required'         => 'Cubic meter cannot be empty.',
                'container_standart.required'  => 'Container standar cannot be empty.',
                'container_stock.required'     => 'Container stock cannot be empty.',
                'container_max_stock.required' => 'Container max stock cannot be empty.',
                'description.required'         => 'Description cannot be empty.',
                'status.required'              => 'Please select a status.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query = Product::create([
                    'type_id'             => $request->type_id,
                    'company_id'          => $request->company_id,
                    'hs_code_id'          => $request->hs_code_id,
                    'brand_id'            => $request->brand_id,
                    'country_id'          => $request->country_id,
                    'supplier_id'         => $request->supplier_id,
                    'grade_id'            => $request->grade_id,
                    'carton_pallet'       => $request->carton_pallet,
                    'carton_pcs'          => $request->carton_pcs,
                    'carton_sqm'          => $request->carton_sqm,
                    'selling_unit'        => $request->selling_unit,
                    'cubic_meter'         => $request->cubic_meter,
                    'container_standart'  => $request->container_standart,
                    'container_stock'     => $request->container_stock,
                    'container_max_stock' => $request->container_max_stock,
                    'description'         => $request->description,
                    'status'              => $request->status
                ]);

                if($query) {
                    if($request->shading_warehouse_code) {
                        foreach($request->shading_warehouse_code as $key => $swc) {
                            ProductShading::create([
                                'product_id'     => $query->id,
                                'warehouse_code' => $swc,
                                'code'           => $request->shading_code[$key],
                                'qty'            => $request->shading_qty[$key]
                            ]);
                        }
                    }

                    activity()
                        ->performedOn(new Product())
                        ->causedBy(session('id'))
                        ->withProperties($query)
                        ->log('Add product code data');

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
        $data    = Product::find($request->id);
        $shading = [];

        if($data->productShading) {
            foreach($data->productShading as $pd) {
                $shading[] = [
                    'warehouse' => $pd->warehouse->name,
                    'code'      => $pd->code,
                    'qty'       => $pd->qty
                ];
            }
        }

        return response()->json([
            'code'                => $data->code(),
            'type'                => $data->type->code,
            'company'             => $data->company->name,
            'hs_code'             => $data->hsCode->name,
            'brand'               => $data->brand->name,
            'country'             => $data->country->name,
            'supplier'            => $data->supplier->name,
            'grade'               => $data->grade->name,
            'carton_pallet'       => $data->carton_pallet . '<sub> / carton</sub>',
            'carton_pcs'          => $data->carton_pcs . '<sub> / pcs</sub>',
            'carton_sqm'          => $data->carton_sqm . '<sub> / carton</sub>',
            'selling_unit'        => $data->selling_unit,
            'cubic_meter'         => $data->cubic_meter,
            'container_standart'  => $data->container_standart,
            'container_stock'     => $data->container_stock,
            'container_max_stock' => $data->container_max_stock,
            'description'         => $data->description,
            'status'              => $data->status(),
            'shading'             => $shading
        ]);
    }

}
