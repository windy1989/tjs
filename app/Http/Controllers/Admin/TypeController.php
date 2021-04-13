<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Unit;
use App\Models\Color;
use App\Models\Pattern;
use App\Models\Surface;
use App\Models\Category;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Models\Specification;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Product Type',
            'content' => 'admin.product.type'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'image',
            'code',
            'surface_id',
            'color_id',
            'pattern_id',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Type::count();
        
        $query_data = Type::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhereHas('surface', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('color', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('pattern', function($query) use ($search) {
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

        $total_filtered = Type::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhereHas('surface', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('color', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('pattern', function($query) use ($search) {
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
                if(Storage::exists($val->image)) {
                    $image = '<a href="' . asset(Storage::url($val->image)) . '" data-lightbox="' . $val->code . '" data-title="' . $val->code . '"><img src="' . asset(Storage::url($val->image)) . '" style="max-width:70px;" class="img-fluid img-thumbnail"></a>';
                } else {
                    $image = '<a href="' . asset('website/empty.jpg') . '" data-lightbox="' . $val->code . '" data-title="' . $val->code . '"><img src="' . asset('website/empty.jpg') . '" style="max-width:70px;" class="img-fluid img-thumbnail"></a>';
                }

                $response['data'][] = [
                    $nomor,
                    $image,
                    $val->code,
                    $val->surface->name,
                    $val->color->name,
                    $val->pattern->name,
                    $val->status(),
                    '
                        <button type="button" class="btn bg-info btn-sm" title="Info" onclick="show(' . $val->id . ')"><i class="icon-info22"></i></button>
                        <a href="' . url('admin/product/type/update/' . $val->id) . '" class="btn bg-warning btn-sm" title="Edit"><i class="icon-pencil7"></i></a>
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

    public function create(Request $request)
    {
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'category_id'      => 'required',
                'division_id'      => 'required',
                'color_id'         => 'required',
                'pattern_id'       => 'required',
                'specification_id' => 'required',
                'buy_unit_id'      => 'required',
                'stock_unit_id'    => 'required',
                'selling_unit_id'  => 'required',
                'image'            => 'mimes:jpg,jpeg,png|max:100|dimensions:width=400,height=400',
                'code'             => 'required|unique:types,code',
                'material'         => 'required',
                'weight'           => 'required',
                'conversion'       => 'required',
                'stockable'        => 'required',
                'min_stock'        => 'required',
                'max_stock'        => 'required',
                'small_stock'      => 'required',
                'status'           => 'required'
            ], [
                'category_id.required'      => 'Please select a category.',
                'division_id.required'      => 'Please select a division.',
                'color_id.required'         => 'Please select a color.',
                'pattern_id.required'       => 'Please select a pattern.',
                'specification_id.required' => 'Please select a loading limit.',
                'buy_unit_id.required'      => 'Please select a buy unit.',
                'stock_unit_id.required'    => 'Please select a stock unit.',
                'selling_unit_id.required'  => 'Please select a selling unit.',
                'image.image'               => 'File must be an image.',
                'image.mimes'               => 'Image must have an extension jpg, jpeg, png.',
                'image.max'                 => 'Image max 100KB.',
                'image.dimensions'          => 'Image size must be 400x400.',
                'code.required'             => 'Code cannot be empty.',
                'code.unique'               => 'Code already exists.',
                'material.required'         => 'Please select a material.',
                'weight.required'           => 'Weight cannot be empty.',
                'conversion.required'       => 'Conversion cannot be empty.',
                'stockable.required'        => 'Please select a need stock.',
                'min_stock.required'        => 'Min stock cannot be empty.',
                'max_stock.required'        => 'Max stock cannot be empty.',
                'small_stock.required'      => 'Small stock cannot be empty.',
                'status.required'           => 'Please select a status.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query = Type::create([
                    'category_id'      => $request->category_id,
                    'division_id'      => $request->division_id,
                    'surface_id'       => $request->surface_id,
                    'color_id'         => $request->color_id,
                    'pattern_id'       => $request->pattern_id,
                    'specification_id' => $request->specification_id,
                    'buy_unit_id'      => $request->buy_unit_id,
                    'stock_unit_id'    => $request->stock_unit_id,
                    'selling_unit_id'  => $request->selling_unit_id,
                    'image'            => $request->has('image') ? $request->file('image')->store('public/product') : null,
                    'code'             => $request->code,
                    'material'         => $request->material,
                    'faces'            => $request->faces,
                    'length'           => $request->length,
                    'width'            => $request->width,
                    'height'           => $request->height,
                    'weight'           => $request->weight,
                    'thickness'        => $request->thickness,
                    'conversion'       => $request->conversion,
                    'stockable'        => $request->stockable,
                    'min_stock'        => $request->min_stock,
                    'max_stock'        => $request->max_stock,
                    'small_stock'      => $request->small_stock,
                    'status'           => $request->status
                ]);

                if($query) {
                    activity()
                        ->performedOn(new Type())
                        ->causedBy(session('id'))
                        ->withProperties($query)
                        ->log('Add product type data');

                    return redirect()->back()->with(['success' => 'Data added successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to added.']);
                }
            }
        } else {
            $data = [
                'title'         => 'Create New Product Type',
                'category'      => Category::where('status', 1)->where('parent_id', 0)->oldest('name')->get(),
                'division'      => Division::where('status', 1)->get(),
                'surface'       => Surface::where('status', 1)->get(),
                'color'         => Color::where('status', 1)->get(),
                'pattern'       => Pattern::where('status', 1)->get(),
                'specification' => Specification::where('status', 1)->get(),
                'unit'          => Unit::where('status', 1)->get(),
                'content'       => 'admin.product.type_create'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function update(Request $request, $id)
    {
        $query = Type::find($id);
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'category_id'      => 'required',
                'division_id'      => 'required',
                'color_id'         => 'required',
                'pattern_id'       => 'required',
                'specification_id' => 'required',
                'buy_unit_id'      => 'required',
                'stock_unit_id'    => 'required',
                'selling_unit_id'  => 'required',
                'image'            => 'mimes:jpg,jpeg,png|max:100|dimensions:width=400,height=400',
                'code'             => ['required', Rule::unique('types', 'code')->ignore($id)],
                'material'         => 'required',
                'weight'           => 'required',
                'conversion'       => 'required',
                'stockable'        => 'required',
                'min_stock'        => 'required',
                'max_stock'        => 'required',
                'small_stock'      => 'required',
                'status'           => 'required'
            ], [
                'category_id.required'      => 'Please select a category.',
                'division_id.required'      => 'Please select a division.',
                'color_id.required'         => 'Please select a color.',
                'pattern_id.required'       => 'Please select a pattern.',
                'specification_id.required' => 'Please select a loading limit.',
                'buy_unit_id.required'      => 'Please select a buy unit.',
                'stock_unit_id.required'    => 'Please select a stock unit.',
                'selling_unit_id.required'  => 'Please select a selling unit.',
                'image.image'               => 'File must be an image.',
                'image.mimes'               => 'Image must have an extension jpg, jpeg, png.',
                'image.max'                 => 'Image max 100KB.',
                'image.dimensions'          => 'Image size must be 400x400.',
                'code.required'             => 'Code cannot be empty.',
                'code.unique'               => 'Code already exists.',
                'material.required'         => 'Please select a material.',
                'weight.required'           => 'Weight cannot be empty.',
                'conversion.required'       => 'Conversion cannot be empty.',
                'stockable.required'        => 'Please select a need stock.',
                'min_stock.required'        => 'Min stock cannot be empty.',
                'max_stock.required'        => 'Max stock cannot be empty.',
                'small_stock.required'      => 'Small stock cannot be empty.',
                'status.required'           => 'Please select a status.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                if($request->has('image')) {
                    if(Storage::exists($query->image)) {
                        Storage::delete($query->image);
                    }

                    $image = $request->file('image')->store('public/product');
                } else {
                    $image = $query->image;
                }

                $query->update([
                    'category_id'      => $request->category_id,
                    'division_id'      => $request->division_id,
                    'surface_id'       => $request->surface_id,
                    'color_id'         => $request->color_id,
                    'pattern_id'       => $request->pattern_id,
                    'specification_id' => $request->specification_id,
                    'buy_unit_id'      => $request->buy_unit_id,
                    'stock_unit_id'    => $request->stock_unit_id,
                    'selling_unit_id'  => $request->selling_unit_id,
                    'image'            => $image,
                    'code'             => $request->code,
                    'material'         => $request->material,
                    'faces'            => $request->faces,
                    'length'           => $request->length,
                    'width'            => $request->width,
                    'height'           => $request->height,
                    'weight'           => $request->weight,
                    'thickness'        => $request->thickness,
                    'conversion'       => $request->conversion,
                    'stockable'        => $request->stockable,
                    'min_stock'        => $request->min_stock,
                    'max_stock'        => $request->max_stock,
                    'small_stock'      => $request->small_stock,
                    'status'           => $request->status
                ]);

                if($query) {
                    activity()
                        ->performedOn(new Type())
                        ->causedBy(session('id'))
                        ->log('Change the product type data');

                    return redirect()->back()->with(['success' => 'Data updated successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to update.']);
                }
            }
        } else {
            $data = [
                'title'         => 'Update Product Type',
                'category'      => Category::where('status', 1)->where('parent_id', 0)->oldest('name')->get(),
                'division'      => Division::where('status', 1)->get(),
                'surface'       => Surface::where('status', 1)->get(),
                'color'         => Color::where('status', 1)->get(),
                'pattern'       => Pattern::where('status', 1)->get(),
                'specification' => Specification::where('status', 1)->get(),
                'unit'          => Unit::where('status', 1)->get(),
                'type'          => $query,
                'content'       => 'admin.product.type_update'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function show(Request $request)
    {
        $data = Type::find($request->id);

        if(Storage::exists($data->image)) {
            $image = asset(Storage::url($data->image));
        } else {
            $image = asset('website/empty.jpg');
        }

        return response()->json([
            'category'      => $data->category->name,
            'division'      => $data->division->name,
            'surface'       => $data->surface ? $data->surface->name : '-',
            'color'         => $data->color->name,
            'pattern'       => $data->pattern->name,
            'specification' => $data->specification->name,
            'buy_unit'      => $data->buyUnit->name,
            'stock_unit'    => $data->stockUnit->name,
            'selling_unit'  => $data->sellingUnit->name,
            'image'         => $image,
            'code'          => $data->code,
            'material'      => $data->material(),
            'faces'         => $data->faces ? $data->faces : 'Not Set',
            'lengths'       => $data->length ? $data->length . ' Cm' : 'Not Set',
            'width'         => $data->width ? $data->width . ' Cm' : 'Not Set',
            'height'        => $data->height ? $data->height . ' Cm' : 'Not Set',
            'weight'        => $data->weight . ' Kg',
            'thickness'     => $data->thickness ? $data->thickness . ' Cm' : 'Not Set',
            'conversion'    => $data->conversion,
            'stockable'     => $data->stockable ? 'Yes' : 'No',
            'small_stock'   => $data->small_stock,
            'min_stock'     => $data->min_stock,
            'max_stock'     => $data->max_stock,
            'status'        => $data->status()
        ]);
    }

    public function destroy(Request $request) 
    {
        $query = Type::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new Type())
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
