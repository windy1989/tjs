<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transport;
use Illuminate\Http\Request;
use App\Models\TransportType;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransportController extends Controller {
    
    public function index()
    {
        $data = [
            'title'          => 'Delivery Transport',
            'transport_type' => TransportType::all(),
            'content'        => 'admin.delivery.transport'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'plat_number',
            'fleet',
            'transport_type_id'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Transport::count();
        
        $query_data = Transport::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('plat_number', 'like', "%$search%")
                            ->orWhere('fleet', 'like', "%$search%")
                            ->orWhereHas('transportType', function($query) use ($request) {
                                    $query->where('name', 'like', "%$search%");
                                });
                    });
                }     
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Transport::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('plat_number', 'like', "%$search%")
                            ->orWhere('fleet', 'like', "%$search%")
                            ->orWhereHas('transportType', function($query) use ($request) {
                                    $query->where('name', 'like', "%$search%");
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
                    $nomor,
                    $val->plat_number,
                    $val->fleet,
                    $val->transportType->name,
                    '
                        <button type="button" class="btn bg-warning btn-sm" data-popup="tooltip" title="Edit" onclick="show(' . $val->id . ')"><i class="icon-pencil7"></i></button>
                        <button type="button" class="btn bg-danger btn-sm" data-popup="tooltip" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>
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
            'plat_number'       => 'required|unique:transports,plat_number',
            'fleet'             => 'required',
            'transport_type_id' => 'required'
        ], [
            'plat_number.required'       => 'Plat number cannot be empty',
            'plat_number.unique'         => 'Plat number exists',
            'fleet.required'             => 'Fleet cannot be empty',
            'transport_type_id.required' => 'Please select a type.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Transport::create([
                'transport_type_id' => $request->transport_type_id,
                'plat_number'       => $request->plat_number,
                'fleet'             => $request->fleet
            ]);

            if($query) {
                activity()
                    ->performedOn(new Transport())
                    ->causedBy(session('bo_id'))
                    ->withProperties($query)
                    ->log('Add delivery transport data');

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
        $data = Transport::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'plat_number'       => ['required', Rule::unique('transports', 'plat_number')->ignore($id)],
            'fleet'             => 'required',
            'transport_type_id' => 'required'
        ], [
            'plat_number.required'       => 'Plat number cannot be empty',
            'plat_number.unique'         => 'Plat number exists',
            'fleet.required'             => 'Fleet cannot be empty',
            'transport_type_id.required' => 'Please select a type.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Transport::where('id', $id)->update([
                'transport_type_id' => $request->transport_type_id,
                'plat_number'       => $request->plat_number,
                'fleet'             => $request->fleet
            ]);

            if($query) {
                activity()
                    ->performedOn(new Transport())
                    ->causedBy(session('bo_id'))
                    ->log('Change the transport delivery data');

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
        $query = Transport::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new Transport())
                ->causedBy(session('bo_id'))
                ->log('Delete the transport delivery data');

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
