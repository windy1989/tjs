<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coa;
use App\Models\User;
use App\Models\Journal;
use App\Models\CashBank;
use Illuminate\Http\Request;
use App\Models\CashBankDetail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CashBankController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Acounting Cash & Bank',
            'user'    => User::all(),
            'coa'     => Coa::where('status', 1)->oldest('code')->get(),
            'content' => 'admin.accounting.cash_bank'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'detail',
            'id',
            'user_id',
            'code',
            'total',
            'date',
            'description'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = CashBank::count();
        
        $query_data = CashBank::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->whereHas('user', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('description', 'like', "%$search%");
                    });
                }     
                
                if($request->user_id) {
                    $query->where('user_id', $request->user_id);
                }

                if($request->start_date && $request->finish_date) {
                    $query->whereDate('date', '>=', $request->start_date)
                        ->whereDate('date', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->whereDate('date', $request->start_date);
                } else if($request->finish_date) {
                    $query->whereDate('date', $request->finish_date);
                }

                if($request->start_nominal && $request->finish_nominal) {
                    $query->whereDate('nominal', '>=', $request->start_nominal)
                        ->whereDate('nominal', '<=', $request->finish_nominal);
                } else if($request->start_nominal) {
                    $query->whereDate('nominal', $request->start_nominal);
                } else if($request->finish_nominal) {
                    $query->whereDate('nominal', $request->finish_nominal);
                }

                if($request->type) {
                    $query->where('type', $request->type);
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = CashBank::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->whereHas('user', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('description', 'like', "%$search%");
                    });
                }     
                
                if($request->user_id) {
                    $query->where('user_id', $request->user_id);
                }

                if($request->start_date && $request->finish_date) {
                    $query->whereDate('date', '>=', $request->start_date)
                        ->whereDate('date', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->whereDate('date', $request->start_date);
                } else if($request->finish_date) {
                    $query->whereDate('date', $request->finish_date);
                }

                if($request->start_nominal && $request->finish_nominal) {
                    $query->whereDate('nominal', '>=', $request->start_nominal)
                        ->whereDate('nominal', '<=', $request->finish_nominal);
                } else if($request->start_nominal) {
                    $query->whereDate('nominal', $request->start_nominal);
                } else if($request->finish_nominal) {
                    $query->whereDate('nominal', $request->finish_nominal);
                }

                if($request->type) {
                    $query->where('type', $request->type);
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
                    $val->user->name,
                    $val->code,
                    number_format($val->cashBankDetail->sum('nominal')),
                    date('d F Y', strtotime($val->date)),
                    $val->description,
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

    public function rowDetail(Request $request)
    {
        $data   = CashBankDetail::where('cash_bank_id', $request->id)->get();
        $string = '<div class="list-feed">';

        foreach($data as $d) {
            $string .= '
                <div class="list-feed-item">
                    <div>
                        <b>[DEBIT]</b>&nbsp;&nbsp;&nbsp;
                        ' . $d->coaDebit->name . '
                    </div>
                    <div>
                        <b>[CREDIT]</b>&nbsp;&nbsp;&nbsp;
                        ' . $d->coaCredit->name . '
                    </div>
                    <div>
                        <b>[NOMINAL]</b>&nbsp;&nbsp;&nbsp;
                        <span class="text-muted">' . number_format($d->nominal) . '</span>
                    </div>
                </div>
            ';
        }

        $string .= '</div>';

        return response()->json($string);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code'           => 'required|unique:cash_banks,code',
            'debit_detail'   => 'required',
            'credit_detail'  => 'required',
            'nominal_detail' => 'required',
            'date'           => 'required',
            'type'           => 'required',
            'description'    => 'required'
        ], [
            'code.required'           => 'Code cannot be a empty.',
            'code.unique'             => 'Code already exists.',
            'debit_detail.required'   => 'Detail transaction cannot be a empty.',
            'credit_detail.required'  => 'Detail transaction cannot be a empty.',
            'nominal_detail.required' => 'Detail transaction cannot be a empty.',
            'date.required'           => 'Date cannot be empty.',
            'type.required'           => 'Please select a type.',
            'description.required'    => 'Description cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = CashBank::create([
                'user_id'     => session('bo_id'),
                'code'        => $request->code,
                'date'        => $request->date,
                'type'        => $request->type,
                'description' => $request->description
            ]);

            if($query) {
                foreach($request->debit_detail as $key => $dd) {
                    CashBankDetail::create([
                        'cash_bank_id' => $query->id,
                        'debit'        => $dd,
                        'credit'       => $request->credit_detail[$key],
                        'nominal'      => $request->nominal_detail[$key]
                    ]);

                    Journal::insert([
                        'journalable_type' => 'cash_banks',
                        'journalable_id'   => $query->id,
                        'debit'            => $dd,
                        'credit'           => $request->credit_detail[$key],
                        'nominal'          => $request->nominal_detail[$key],
                        'created_at'       => date('Y-m-d', strtotime($query->date)) . ' ' . date('H:i:s'),
                        'updated_at'       => date('Y-m-d H:i:s')
                    ]);
                }

                activity()
                    ->performedOn(new CashBank())
                    ->causedBy(session('bo_id'))
                    ->withProperties($query)
                    ->log('Add accounting cash & bank data');

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
        $data             = CashBank::find($request->id);
        $cash_bank_detail = [];

        foreach($data->cashBankDetail as $cbd) {
            $cash_bank_detail[] = [
                'debit_id'    => $cbd->debit,
                'debit_name'  => '[' . $cbd->coaDebit->code . '] ' . $cbd->coaDebit->name,
                'credit_id'   => $cbd->credit,
                'credit_name' => '[' . $cbd->coaCredit->code . '] ' . $cbd->coaCredit->name,
                'nominal'     => $cbd->nominal
            ];
        }

        return response()->json([
            'code'             => $data->code,
            'date'             => $data->date,
            'type'             => $data->type,
            'description'      => $data->description,
            'cash_bank_detail' => $cash_bank_detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $query      = CashBank::find($id);
        $validation = Validator::make($request->all(), [
            'code'           => ['required', Rule::unique('cash_banks', 'code')->ignore($id)],
            'debit_detail'   => 'required',
            'credit_detail'  => 'required',
            'nominal_detail' => 'required',
            'date'           => 'required',
            'type'           => 'required',
            'description'    => 'required'
        ], [
            'code.required'           => 'Code cannot be a empty.',
            'code.unique'             => 'Code already exists.',
            'debit_detail.required'   => 'Detail transaction cannot be a empty.',
            'credit_detail.required'  => 'Detail transaction cannot be a empty.',
            'nominal_detail.required' => 'Detail transaction cannot be a empty.',
            'date.required'           => 'Date cannot be empty.',
            'type.required'           => 'Please select a type.',
            'description.required'    => 'Description cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query->update([
                'user_id'     => session('bo_id'),
                'code'        => $request->code,
                'date'        => $request->date,
                'type'        => $request->type,
                'description' => $request->description
            ]);

            if($query) {
                CashBankDetail::where('cash_bank_id', $query->id)->delete();
                DB::table('journals')
                    ->where('journalable_type', 'cash_banks')
                    ->where('journalable_id', $query->id)
                    ->delete();

                foreach($request->debit_detail as $key => $dd) {
                    CashBankDetail::create([
                        'cash_bank_id' => $query->id,
                        'debit'        => $dd,
                        'credit'       => $request->credit_detail[$key],
                        'nominal'      => $request->nominal_detail[$key]
                    ]);

                    Journal::insert([
                        'journalable_type' => 'cash_banks',
                        'journalable_id'   => $query->id,
                        'debit'            => $dd,
                        'credit'           => $request->credit_detail[$key],
                        'nominal'          => $request->nominal_detail[$key],
                        'created_at'       => date('Y-m-d', strtotime($query->date)) . ' ' . date('H:i:s'),
                        'updated_at'       => date('Y-m-d H:i:s')
                    ]);
                }

                activity()
                    ->performedOn(new CashBank())
                    ->causedBy(session('bo_id'))
                    ->log('Change the accounting cash bank data');

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
        $query = CashBank::find($request->id);
        if($query->delete()) {
            Journal::where('description', $query->code)->delete();
            activity()
                ->performedOn(new CashBank())
                ->causedBy(session('bo_id'))
                ->log('Delete the accounting cash bank data');

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
