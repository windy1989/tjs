<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agent;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller {
    
    public function index()
    {
        $data = [
            'title'    => 'QC Fee',
            'country'  => Country::all(),
            'category' => Category::where('parent_id', 0)->oldest('name')->get(),
            'content'  => 'admin.master_data.cogs_master.qc_fee'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'country_id',
            'category_id',
            'min_price',
            'max_price',
            'fee'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Agent::count();
        
        $query_data = Agent::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('country', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('category', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }    
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Agent::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('country', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('category', function($query) use ($search) {
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
                    $val->country->code,
                    $val->category->name,
                    '$' . number_format($val->min_price, 2, ',', '.'),
                    '$' . number_format($val->max_price, 2, ',', '.'),
                    '$' . number_format($val->fee, 2, ',', '.'),
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
            'country_id'  => 'required',
            'category_id' => 'required',
            'min_price'   => 'required',
            'max_price'   => 'required',
            'fee'         => 'required'
        ], [
            'country_id.required'  => 'Please select a country.',
            'category_id.required' => 'Please select a category.',
            'min_price.required'   => 'Min price cannot be empty.',
            'max_price.required'   => 'Max price cannot be empty.',
            'fee.required'         => 'Fee cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Agent::create([
                'country_id'  => $request->country_id,
                'category_id' => $request->category_id,
                'min_price'   => str_replace(',', '', $request->min_price),
                'max_price'   => str_replace(',', '', $request->max_price),
                'fee'         => str_replace(',', '', $request->fee)
            ]);

            if($query) {
                activity()
                    ->performedOn(new Agent())
                    ->causedBy(session('bo_id'))
                    ->withProperties($query)
                    ->log('Add cogs agent data');

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
        $data = Agent::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'country_id'  => 'required',
            'category_id' => 'required',
            'min_price'   => 'required',
            'max_price'   => 'required',
            'fee'         => 'required'
        ], [
            'country_id.required'  => 'Please select a country.',
            'category_id.required' => 'Please select a category.',
            'min_price.required'   => 'Min price cannot be empty.',
            'max_price.required'   => 'Max price cannot be empty.',
            'fee.required'         => 'Fee cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Agent::where('id', $id)->update([
                'country_id'  => $request->country_id,
                'category_id' => $request->category_id,
                'min_price'   => str_replace(',', '', $request->min_price),
                'max_price'   => str_replace(',', '', $request->max_price),
                'fee'         => str_replace(',', '', $request->fee)
            ]);

            if($query) {
                activity()
                    ->performedOn(new Agent())
                    ->causedBy(session('bo_id'))
                    ->log('Change the cogs agent data');

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
        $query = Agent::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new Agent())
                ->causedBy(session('bo_id'))
                ->log('Delete the cogs agent data');

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
