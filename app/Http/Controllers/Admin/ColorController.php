<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Master Color',
            'content' => 'admin.master_data.color'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'code',
            'name',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Color::count();
        
        $query_data = Color::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
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

        $total_filtered = Color::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
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
                    $val->name,
                    $val->status(),
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

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code'   => 'required|unique:colors,code',
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
            $query = Color::create([
                'code'   => $request->code,
                'name'   => $request->name,
                'status' => $request->status
            ]);

            if($query) {
                activity()
                    ->performedOn(new Color())
                    ->causedBy(session('id'))
                    ->withProperties($query)
                    ->log('Add master color data');

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
        $data = Color::find($request->id);
        return response()->json([
            'code'   => $data->code,
            'name'   => $data->name,
            'status' => $data->status
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'code'   => ['required', Rule::unique('colors', 'code')->ignore($id)],
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
            $query = Color::where('id', $id)->update([
                'code'   => $request->code,
                'name'   => $request->name,
                'status' => $request->status
            ]);

            if($query) {
                activity()
                    ->performedOn(new Color())
                    ->causedBy(session('id'))
                    ->log('Change the color master data');

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
        $query = Color::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new Color())
                ->causedBy(session('id'))
                ->log('Delete the color master data');

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