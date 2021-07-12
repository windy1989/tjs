<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coa;
use App\Models\Budgeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BudgetingController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Accounting Budgeting',
            'coa'     => Coa::oldest('code')->get(),    
            'content' => 'admin.accounting.budgeting'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'coa_id',
            'month',
            'nominal'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Budgeting::count();
        
        $query_data = Budgeting::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('coa', function($query) use ($search) {
                                $query->where('code', 'like', "%$search%")
                                    ->orWhere('name', 'like', "%$search%");
                            });
                    });
                }  
                
                if($request->coa) {
                    $query->where('coa_id', $request->coa);
                }
                
                if($request->start_date && $request->finish_date) {
                    $query->where('month', '>=', $request->start_date)
                        ->where('month', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->where('month', $request->start_date);
                } else if($request->finish_date) {
                    $query->where('month', $request->finish_date);
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Budgeting::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('coa', function($query) use ($search) {
                                $query->where('code', 'like', "%$search%")
                                    ->orWhere('name', 'like', "%$search%");
                            });
                    });
                }         

                if($request->coa) {
                    $query->where('coa_id', $request->coa);
                }
                
                if($request->start_date && $request->finish_date) {
                    $query->where('month', '>=', $request->start_date)
                        ->where('month', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->where('month', $request->start_date);
                } else if($request->finish_date) {
                    $query->where('month', $request->finish_date);
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $response['data'][] = [
                    $nomor,
                    '[' . $val->coa->code . '] ' . $val->coa->name,
                    date('F Y', strtotime($val->month)),
                    number_format($val->nominal, 0, ',', '.'),
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
            'coa_id'  => 'required',
            'month'   => 'required',
            'nominal' => 'required'
        ], [
            'coa_id.required'  => 'Please select a coa.',
            'month.required'   => 'Month cannot be a empty.',
            'nominal.required' => 'Nominal cannot be a empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Budgeting::create([
                'coa_id'  => $request->coa_id,
                'month'   => $request->month,
                'nominal' => $request->nominal
            ]);

            if($query) {
                activity()
                    ->performedOn(new Budgeting())
                    ->causedBy(session('bo_id'))
                    ->withProperties($query)
                    ->log('Add accounting budgeting data');

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
        $data = Budgeting::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'coa_id'  => 'required',
            'month'   => 'required',
            'nominal' => 'required'
        ], [
            'coa_id.required'  => 'Please select a coa.',
            'month.required'   => 'Month cannot be a empty.',
            'nominal.required' => 'Nominal cannot be a empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Budgeting::where('id', $id)->update([
                'coa_id'  => $request->coa_id,
                'month'   => $request->month,
                'nominal' => $request->nominal
            ]);

            if($query) {
                activity()
                    ->performedOn(new Budgeting())
                    ->causedBy(session('bo_id'))
                    ->log('Change the accounting budgeting data');

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
        $query = Budgeting::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new Budgeting())
                ->causedBy(session('bo_id'))
                ->log('Delete the accounting budgeting data');

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
