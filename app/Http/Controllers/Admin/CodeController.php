<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Brand;
use App\Models\Grade;
use App\Models\HsCode;
use App\Models\Company;
use App\Models\Country;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\ProductShading;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CodeController extends Controller {

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

    public function formula(Request $request)
    {
        $type = Type::find($request->type_id);
        if($type) {
            $carton_sqm  = ($type->length / 100) * ($type-> width / 100) * $request->carton_pcs;
            $cubic_meter = ($type->length / 100) * ($type-> width / 100) * $type->thickness * $request->carton_pcs;
        } else {
            $carton_sqm  = 0;
            $cubic_meter = null;
        }

        if(strpos($type->category->name, 'tile') !== false) {
            $cubic_meter = null;
        }

        return response()->json([
            'carton_sqm'  => round($carton_sqm, 2),
            'cubic_meter' => $cubic_meter ? round($cubic_meter, 2) : $cubic_meter
        ]);
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
                'ventura_code'        => 'required',
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
                'ventura_code.required'        => 'Code ventura cannot be empty.',
                'container_standart.required'  => 'Please select a standart container.',
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
                    'ventura_code'        => $request->ventura_code,
                    'carton_pallet'       => $request->carton_pallet,
                    'carton_pcs'          => $request->carton_pcs,
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
                'title'     => 'Create New Product Code',
                'company'   => Company::where('status', 1)->get(),
                'hs_code'   => HsCode::where('status', 1)->get(),
                'brand'     => Brand::where('status', 1)->get(),
                'country'   => Country::where('status', 1)->get(),
                'supplier'  => Supplier::where('status', 1)->get(),
                'grade'     => Grade::where('status', 1)->get(),
                'warehouse' => Warehouse::where('status', 1)->get(),
                'content'   => 'admin.product.code_create'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function update(Request $request, $id)
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
                'ventura_code'        => 'required',
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
                'ventura_code.required'        => 'Code ventura cannot be empty.',
                'container_standart.required'  => 'Please select a standart container.',
                'container_stock.required'     => 'Container stock cannot be empty.',
                'container_max_stock.required' => 'Container max stock cannot be empty.',
                'description.required'         => 'Description cannot be empty.',
                'status.required'              => 'Please select a status.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query = Product::where('id', $id)->update([
                    'type_id'             => $request->type_id,
                    'company_id'          => $request->company_id,
                    'hs_code_id'          => $request->hs_code_id,
                    'brand_id'            => $request->brand_id,
                    'country_id'          => $request->country_id,
                    'supplier_id'         => $request->supplier_id,
                    'grade_id'            => $request->grade_id,
                    'ventura_code'        => $request->ventura_code,
                    'carton_pallet'       => $request->carton_pallet,
                    'carton_pcs'          => $request->carton_pcs,
                    'container_standart'  => $request->container_standart,
                    'container_stock'     => $request->container_stock,
                    'container_max_stock' => $request->container_max_stock,
                    'description'         => $request->description,
                    'status'              => $request->status
                ]);

                if($query) {
                    ProductShading::where('product_id', $id)->delete();
                    if($request->shading_warehouse_code) {
                        foreach($request->shading_warehouse_code as $key => $swc) {
                            ProductShading::create([
                                'product_id'     => $id,
                                'warehouse_code' => $swc,
                                'code'           => $request->shading_code[$key],
                                'qty'            => $request->shading_qty[$key]
                            ]);
                        }
                    }

                    activity()
                        ->performedOn(new Product())
                        ->causedBy(session('id'))
                        ->log('Change the product code data');

                    return redirect()->back()->with(['success' => 'Data added successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to added.']);
                }
            }
        } else {
            $data = [
                'title'     => 'Update Product Code',
                'company'   => Company::where('status', 1)->get(),
                'hs_code'   => HsCode::where('status', 1)->get(),
                'brand'     => Brand::where('status', 1)->get(),
                'country'   => Country::where('status', 1)->get(),
                'supplier'  => Supplier::where('status', 1)->get(),
                'grade'     => Grade::where('status', 1)->get(),
                'warehouse' => Warehouse::where('status', 1)->get(),
                'product'   => Product::find($id),
                'content'   => 'admin.product.code_update'
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
            'ventura_code'        => $data->ventura_code,
            'carton_pallet'       => $data->carton_pallet . '<sub> / carton</sub>',
            'carton_pcs'          => $data->carton_pcs . '<sub> / pcs</sub>',
            'container_standart'  => $data->containerStandart(),
            'container_stock'     => $data->container_stock,
            'container_max_stock' => $data->container_max_stock,
            'description'         => $data->description,
            'status'              => $data->status(),
            'shading'             => $shading
        ]);
    }

    public function destroy(Request $request) 
    {
        $query = Product::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new Product())
                ->causedBy(session('id'))
                ->log('Delete the product type data');

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
