<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller {
    
    public function index()
    {
        $data = [
            'title'    => 'Product Type',
            'category' => Category::where('status', 1)->where('parent_id', 0)->oldest('name')->get(),
            'content'  => 'admin.product.type'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'code',
            'quality',
            'length',
            'width',
            'height',
            'weight',
            'thickness',
            'price',
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
                $response['data'][] = [
                    $nomor,
                    $val->code,
                    $val->quality(),
                    $val->length,
                    $val->width,
                    $val->weight,
                    $val->height,
                    $val->thickness,
                    number_format($val->price),
                    $val->surface->name,
                    $val->color->name,
                    $val->pattern->name,
                    $val->status(),
                    '
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
                'code'   => 'required|unique:surfaces,code',
                'name'   => 'required',
                'status' => 'required'
            ], [
                'code.required'   => 'Code cannot be empty.',
                'code.unique'     => 'Code already exists.',
                'name.required'   => 'Name cannot be empty.',
                'status.required' => 'Please select a status.'
            ]);

            if($validation->fails()) {
                $response = [
                    'status' => 422,
                    'error'  => $validation->errors()
                ];
            } else {
                $query = Surface::create([
                    'code'   => $request->code,
                    'name'   => $request->name,
                    'status' => $request->status
                ]);

                if($query) {
                    activity()
                        ->performedOn(new Surface())
                        ->causedBy(session('id'))
                        ->withProperties($query)
                        ->log('Add master surface data');

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
        } else {
            $data = [
                'title'   => 'Create New Product Type',
                'content' => 'admin.product.type_create'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'code'   => ['required', Rule::unique('surfaces', 'code')->ignore($id)],
            'name'   => 'required',
            'status' => 'required'
        ], [
            'code.required'   => 'Code cannot be empty.',
            'code.unique'     => 'Code already exists.',
            'name.required'   => 'Name cannot be empty.',
            'status.required' => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Surface::where('id', $id)->update([
                'code'   => $request->code,
                'name'   => $request->name,
                'status' => $request->status
            ]);

            if($query) {
                activity()
                    ->performedOn(new Surface())
                    ->causedBy(session('id'))
                    ->log('Change the surface master data');

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
        $query = Surface::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new Surface())
                ->causedBy(session('id'))
                ->log('Delete the surface master data');

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
