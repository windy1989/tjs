<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coa;
use App\Models\User;
use App\Models\Journal;
use App\Models\CashBank;
use Illuminate\Http\Request;
use App\Models\CashBankDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CashBankController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Acounting Cash & Bank',
            'user'    => User::all(),
            'parent'  => Coa::where('parent_id', 0)->oldest('code')->get(),
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
                    date('d F Y', strtotime($val->date)),
                    '[' . $val->type() . '] ' . $val->description
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
        $string = '<ul class="mt-3">';

        foreach($data as $d) {
            $string .= '<li>' . $d->coaDebit->name . '<b>&nbsp;[Debit]</b><br>' . $d->coaCredit->name . '<b>&nbsp;[Credit]</b><br>' . number_format($d->nominal) . '</li>';
        }

        $string .= '</ul>';

        return response()->json($string);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'debit_detail'   => 'required',
            'credit_detail'  => 'required',
            'nominal_detail' => 'required',
            'date'           => 'required',
            'type'           => 'required',
            'description'    => 'required'
        ], [
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
                'code'        => CashBank::generateCode($request->type),
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

                    Journal::create([
                        'debit'       => $dd,
                        'credit'      => $request->credit_detail[$key],
                        'nominal'     => $request->nominal_detail[$key],
                        'description' => $query->code
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

}
