<?php

namespace App\Http\Controllers\Admin;

use App\Helper\SMB;
use App\Models\Coa;
use App\Models\Paper;
use App\Models\Journal;
use Illuminate\Http\Request;
use App\Models\CashBankDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ReportAccountingController extends Controller {

    public function balanceSheet(Request $request) 
    {
        $filter = $request->filter ? $request->filter : date('Y-m');
        $data   = [
            'title'         => 'Balance Sheet',
            'balance_sheet' => SMB::reportBalanceSheet($filter),
            'filter'        => $filter,
            'content'       => 'admin.report.accounting.balance_sheet'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function profitLoss(Request $request) 
    {
        $filter = $request->filter ? $request->filter : date('Y-m');
        $total  = [
            'income_actual_percent_current' => 0,
            'income_actual_percent_last'    => 0,
            'income_budget_percent'         => 0,
            'fee_actual_percent_current'    => 0,
            'fee_actual_percent_last'       => 0,
            'fee_budget_percent'            => 0
        ];

        $data   = [
            'title'       => 'Profit & Loss',
            'profit_loss' => SMB::reportProfitLoss($filter),
            'filter'      => $filter,
            'total'       => $total,
            'content'     => 'admin.report.accounting.profit_loss'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function ledger() 
    {
        $data = [
            'title'   => 'Ledger',
            'coa'     => Coa::all(),
            'content' => 'admin.report.accounting.ledger'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function ledgerDatatable(Request $request)
    {
        $column = [
            'detail',
            'id',
            'date',
            'name',
            'beginning',
            'debit',
            'credit',
            'ending'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Coa::where('status', 1)
            ->count();
        
        $query_data = Coa::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }     

                if($request->coa_id) {
                    $query->where('id', $request->coa_id);
                }
            })
            ->where('status', 1)
            ->offset($start)
            ->limit($length)
            ->orderBy('code', 'asc')
            ->get();

        $total_filtered = Coa::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }     

                if($request->coa_id) {
                    $query->where('id', $request->coa_id);
                }
            })
            ->where('status', 1)
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $diff_time_start      = SMB::diffTime($request->start_date, $request->finish_date)->m + 1;
                $diff_time_end        = $diff_time_start - 1;
                $date_begining_start  = date('Y-m-01', strtotime("-$diff_time_start months", strtotime($request->start_date)));
                $date_begining_finish = date('Y-m-t', strtotime("-1 months", strtotime($request->start_date)));
                $date_ending_start    = date('Y-m-01', strtotime($request->start_date));
                $date_ending_finish   = date('Y-m-t', strtotime($request->finish_date));

                $beginning_month_start  = date('m', strtotime($date_begining_start));
                $beginning_year_start   = date('Y', strtotime($date_begining_start));
                $beginning_month_finish = date('m', strtotime($date_begining_finish));
                $beginning_year_finish  = date('Y', strtotime($date_begining_finish));
                $ending_month_start     = date('m', strtotime($date_ending_start));
                $ending_year_start      = date('Y', strtotime($date_ending_start));
                $ending_month_finish    = date('m', strtotime($date_ending_finish));
                $ending_year_finish     = date('Y', strtotime($date_ending_finish));

                if($request->start_date && $request->finish_date) {
                    $beginning_where_raw = "DATE(created_at) >= '$date_begining_start' AND DATE(created_at) <= '$date_begining_finish'";
                    $ending_where_raw    = "DATE(created_at) >= '$date_ending_start' AND DATE(created_at) <= '$date_ending_finish'";
                } else if($request->start_date) {
                    $beginning_where_raw = "YEAR(created_at) <= '$beginning_year_start' AND MONTH(created_at) = '$beginning_month_start'";
                    $ending_where_raw    = "YEAR(created_at) <= '$ending_year_start' AND MONTH(created_at) = '$ending_month_start'";
                } else if($request->finish_date) {
                    $beginning_where_raw = "YEAR(created_at) <= '$beginning_year_finish' AND MONTH(created_at) = '$beginning_month_finish'";
                    $ending_where_raw    = "YEAR(created_at) <= '$ending_year_finish' AND MONTH(created_at) = '$ending_month_finish'";
                } else {
                    $beginning_where_raw = "created_at IS NOT NULL";
                    $ending_where_raw    = "created_at IS NOT NULL";
                }

                $beginning_debit  = $val->journalDebit()->where('type','1')->whereRaw($beginning_where_raw)->sum('nominal');
                $beginning_credit = $val->journalCredit()->where('type','2')->whereRaw($beginning_where_raw)->sum('nominal');
                if(!$request->start_date && !$request->finish_date) {
                    $beginning_total = 0;
                } else {
                    $beginning_total = $beginning_debit - $beginning_credit;
                }

                $ending_debit  = $val->journalDebit()->where('type','1')->whereRaw($ending_where_raw)->sum('nominal');
                $ending_credit = $val->journalCredit()->where('type','2')->whereRaw($ending_where_raw)->sum('nominal');
                $ending_total  = $ending_debit - $ending_credit;

                $response['data'][] = [
                    '<span class="pointer-element badge badge-success" data-id="' . $val->id . '"><i class="icon-plus3"></i></span>',
                    $nomor,
                    $val->name,
                    number_format($beginning_total, 2, ',', '.'),
                    number_format($ending_debit, 2, ',', '.'),
                    number_format($ending_credit, 2, ',', '.'),
                    number_format($beginning_total + $ending_total, 2, ',', '.')
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

    public function ledgerRowDetail(Request $request)
    {
        $string = '<table class="table table-bordered">
					<thead class="table-secondary">
						<tr class="text-center">
							<th>Coa</th>
							<th>Debit</th>
							<th>Kredit</th>
							<th>Note</th>
						</tr>
					</thead>
					<tbody>';

		$journal = Journal::where(function($query) use ($request) {
				$query->where('coa_id', $request->id);
		})
		->where(function($query) use ($request) {
			if($request->start_date && $request->finish_date) {
				$query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->start_date)))
					->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->finish_date)));
			} else if($request->start_date) {
				$query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->start_date)))
					->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->start_date)));
			} else if($request->finish_date) {
				$query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->finish_date)))
					->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->finish_date)));
			}
		})
		->oldest('created_at')
		->get();

        foreach($journal as $d) {
            if($d->type == '1'){
				$string .= '
					<tr>
						<td>'.$d->coa->name.'</td>
						<td class="text-center">'.number_format($d->nominal,2,',','.').'</td>
						<td class="text-center">-</td>
						<td>'.$d->journalable->description.'</td>
					</tr>
				';
			}elseif($d->type == '2'){
				$string .= '
					<tr>
						<td>'.$d->coa->name.'</td>
						<td class="text-center">-</td>
						<td class="text-center">'.number_format($d->nominal,2,',','.').'</td>
						<td>'.$d->journalable->description.'</td>
					</tr>
				';
			}
        }

        $string .= '</tbody></table>';
        
		return response()->json($string);

    }

    public function trialBalance() 
    {
        $data = [
            'title'   => 'Trial Balance',
            'coa'     => Coa::all(),
            'content' => 'admin.report.accounting.trial_balance'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function trialBalanceDatatable(Request $request)
    {
        $column = [
            'id',
            'coa_id',
            'balance_debit',
            'balance_credit',
            'change_debit',
            'change_credit',
            'end_balance_debit',
            'end_balance_credit'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Coa::where('status', 1)
            ->count();
        
        $query_data = Coa::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }     
            })
            ->where('status', 1)
            ->offset($start)
            ->limit($length)
            ->orderBy('code', 'asc')
            ->get();

        $total_filtered = Coa::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }     
            })
            ->where('status', 1)
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $balance_debit = $val->journalDebit()->where('type','1')
                    ->whereYear('created_at', date('Y', strtotime($request->date)))
                    ->whereMonth('created_at', '<', date('m', strtotime($request->date)))
                    ->sum('nominal');

                $balance_credit = $val->journalCredit()->where('type','2')
                    ->whereYear('created_at', date('Y', strtotime($request->date)))
                    ->whereMonth('created_at', '<', date('m', strtotime($request->date)))
                    ->sum('nominal');

                $change_debit = $val->journalDebit()->where('type','1')
                    ->whereYear('created_at', date('Y', strtotime($request->date)))
                    ->whereMonth('created_at', date('m', strtotime($request->date)))
                    ->sum('nominal');

                $change_credit = $val->journalCredit()->where('type','2')
                    ->whereYear('created_at', date('Y', strtotime($request->date)))
                    ->whereMonth('created_at', date('m', strtotime($request->date)))
                    ->sum('nominal');


                $explode_code = explode('.', $val->code);
                if($explode_code[0] == 1 || $explode_code[0] == 5 || $explode_code[0] == 6 || $explode_code[0] == 7) {
                    $end_balance_debit  = $balance_debit + $change_debit - $change_credit;
                    $end_balance_credit = 0;
                } else {
                    $end_balance_debit  = 0;
                    $end_balance_credit = $balance_credit + $change_credit - $change_debit;
                }

                $response['data'][] = [
                    $nomor,
                    $val->name,
                    number_format($balance_debit, 2, ',', '.'),
                    number_format($balance_credit, 2, ',', '.'),
                    number_format($change_debit, 2, ',', '.'),
                    number_format($change_credit, 2, ',', '.'),
                    number_format($end_balance_debit, 2, ',', '.'),
                    number_format($end_balance_credit, 2, ',', '.')
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
    
	public function cashBank(Request $request)
    {
        $result   = [];
        $month    = $request->filter_month ? $request->filter_month : date('Y-m');
        $coa_id   = $request->filter_coa_id ? $request->filter_coa_id : '';
        $code     = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 215];
        $list_coa = Coa::where(function($query) use ($coa_id, $code, $request) {
                if($coa_id) {
                    $query->where('id', $coa_id);
                } else {
                    $query->whereIn('id', $code);
                }
            })
            ->get();

        foreach($list_coa as $lc) {
            $balance_debit  = Journal::where('coa_id', $lc->id)
				->where('type','1')
                ->where(function($query) use ($request) {
                    if($request->has('_token') && session()->token() == $request->_token) {
                        if($request->filter_month) {
                            $query->whereYear('created_at', date('Y', strtotime($request->filter_month)))
                                ->whereMonth('created_at', '<=', date('m', strtotime($request->filter_month)));
                        }
                    }
                })
                ->sum('nominal');

            $balance_credit = Journal::where('coa_id', $lc->id)
				->where('type','2')
                ->where(function($query) use ($request) {
                    if($request->has('_token') && session()->token() == $request->_token) {
                        if($request->filter_month) {
                            $query->whereYear('created_at', date('Y', strtotime($request->filter_month)))
                                ->whereMonth('created_at', '<=', date('m', strtotime($request->filter_month)));
                        }
                    }
                })
                ->sum('nominal');

            $result[] = [
                'id'      => $lc->id,
                'no'      => $lc->code,
                'name'    => $lc->name,
                'debit'   => $balance_debit,
                'credit'  => $balance_credit,
                'balance' => $balance_debit - $balance_credit,
            ];
        }

        $data = [
            'title'   => 'Cash & Bank',
            'month'   => $month,
            'coa_id'  => $coa_id,
            'coa'     => Coa::all(),
            'result'  => $result,
            'content' => 'admin.report.accounting.cash_bank'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function cashBankDetail(Request $request)
    {
        $result  = [];
        $coa     = Coa::find($request->id);
        $journal = Journal::where(function($query) use ($request) {
                $query->whereYear('created_at', date('Y', strtotime($request->month)))
                    ->whereMonth('created_at', '<=', date('m', strtotime($request->month)));
            })
            ->where(function($query) use ($request) {
                $query->where('coa_id', $request->id);
            })
            ->groupBy('id')
            ->get();

        foreach($journal as $j) {
            foreach($j->journalable->cashBankDetail()->where('coa_id',$request->id)->get() as $cbd) {
                $income = CashBankDetail::where(function($query) use ($request, $cbd) {
                        $query->whereDate('created_at', '<=', $cbd->created_at->format('Y-m-d'));
                    })
                    ->where('coa_id', $request->id)->where('type','1')
                    ->sum('nominal');

                $expense = CashBankDetail::where(function($query) use ($request, $cbd) {
                        $query->whereDate('created_at', '<=', $cbd->created_at->format('Y-m-d'));
                    })
                    ->where('coa_id', $request->id)->where('type','2')
                    ->sum('nominal');

                if($cbd->type == '1') {
                    $debit  = $cbd->nominal;
                    $credit = 0;
                } else {
                    $debit  = 0;
                    $credit = $cbd->nominal;
                }

                $result[] = [
                    'date'        => $cbd->created_at->format('d F Y'),
                    'code'        => $j->journalable->code,
                    'description' => $cbd->note,
                    'income'      => number_format($debit, 2, ',', '.'),
                    'expense'     => number_format($credit, 2, ',', '.'),
                    'balance'     => number_format($income - $expense, 2, ',', '.')
                ];
            }
        }

        $checking_account = Paper::where('coa_id', $request->id)
            ->whereYear('created_at', date('Y', strtotime($request->month)))
            ->whereMonth('created_at', date('m', strtotime($request->month)))
            ->first();

        if($checking_account) {
            $image = asset(Storage::url($checking_account->image));
        } else {
            $image = null;
        }

        return response()->json([
            'year'              => date('Y', strtotime($request->month)),
            'month'             => date('F', strtotime($request->month)),
            'name'              => $coa->name,
            'code'              => $coa->code,
            'image'             => $image,
            'total_transaction' => $journal->count(),
            'balance'           => number_format($request->balance, 2, ',', '.'),
            'result'            => $result
        ]);
    }

    public function cashBankUploadFile(Request $request)
    {
        $checking_account = Paper::where('coa_id', $request->coa_id)
            ->whereYear('created_at', date('Y', strtotime($request->month)))
            ->whereMonth('created_at', date('m', strtotime($request->month)))
            ->first();

        if($checking_account) {
            if(Storage::exists($checking_account->image)) {
                Storage::delete($checking_account->image);
            }

            $query = Paper::where('coa_id', $request->coa_id)
                ->whereYear('created_at', date('Y', strtotime($request->month)))
                ->whereMonth('created_at', '<=', date('m', strtotime($request->month)))
                ->update([
                    'image' => $request->file('image')->store('public/paper')
                ]);
        } else {
            $query = Paper::create([
                'coa_id' => $request->coa_id,
                'image'  => $request->file('image')->store('public/paper')
            ]);
        }

        if($query) {
            $response = [
                'status'  => 200,
                'message' => 'Bank statement uploaded successfully.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Bank statement failed to upload.'
            ];
        }

        return response()->json($response);
    }
	
	public function outstandingAR(Request $request) 
    {
		$filter = $request->filter ? $request->filter : date('Y-m');
		
		$resultsby   = [];
		$resultjkt   = [];
        $code     = [28,29];
        $list_journal = Journal::whereIn('coa_id', $code)
			->whereYear('created_at', date('Y', strtotime($filter)))
            ->whereMonth('created_at', date('m', strtotime($filter)))
			->get();

        foreach($list_journal as $lc) {
			$debit = 0;
			$credit = 0;
			if($lc->type == '1'){
				$debit = $lc->nominal;
			}elseif($lc->type == '2'){
				$credit = $lc->nominal;
			}
			
			if($lc->coa_id == 28){
				$resultsby[] = [
					'id'      => $lc->id,
					'no'      => $lc->coa->code,
					'code' 	  => $lc->journalable ? $lc->journalable->code : '',
					'info'    => $lc->journalable ? $lc->journalable->description.' by '.$lc->journalable->projectSale->project->customer->name : '',
					'project' => $lc->journalable ? $lc->journalable->project_id : '',
					'name'    => $lc->coa->name,
					'debit'   => $debit,
					'credit'  => $credit
				];
			}elseif($lc->coa_id == 29){
				$resultjkt[] = [
					'id'      => $lc->id,
					'no'      => $lc->coa->code,
					'code' 	  => $lc->journalable ? $lc->journalable->code : '',
					'info'    => $lc->journalable ? $lc->journalable->description.' by '.$lc->journalable->projectSale->project->customer->name : '',
					'project' => $lc->journalable ? $lc->journalable->project_id : '',
					'name'    => $lc->coa->name,
					'debit'   => $debit,
					'credit'  => $credit
				];
			}
        }

        $data = [
            'title'   	=> 'Outstanding A/R',
			'filter'  	=> $filter,
			'resultsby' => $resultsby,
			'resultjkt' => $resultjkt,
            'content' 	=> 'admin.report.finance.outstanding_a_r'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }
	
	public function outstandingAP(Request $request) 
    {
		$filter = $request->filter ? $request->filter : date('Y-m');
		
		$resultsby   = [];
		$resultjkt   = [];
        $code     = [78,79];
        $list_journal = Journal::whereIn('coa_id', $code)
			->whereYear('created_at', date('Y', strtotime($filter)))
            ->whereMonth('created_at', date('m', strtotime($filter)))
			->get();

        foreach($list_journal as $lc) {
			$debit = 0;
			$credit = 0;
			if($lc->type == '1'){
				$debit = $lc->nominal;
			}elseif($lc->type == '2'){
				$credit = $lc->nominal;
			}
			
			if($lc->coa_id == 78){
				$resultsby[] = [
					'id'      => $lc->id,
					'no'      => $lc->coa->code,
					'code' 	  => $lc->journalable ? $lc->journalable->code : '',
					'info'    => $lc->journalable ? $lc->journalable->description.' to '.$lc->journalable->projectPurchase->supplier->name : '',
					'project' => $lc->journalable ? $lc->journalable->project_id : '',
					'name'    => $lc->coa->name,
					'debit'   => $debit,
					'credit'  => $credit
				];
			}elseif($lc->coa_id == 79){
				$resultjkt[] = [
					'id'      => $lc->id,
					'no'      => $lc->coa->code,
					'code' 	  => $lc->journalable ? $lc->journalable->code : '',
					'info'    => $lc->journalable ? $lc->journalable->description.' to '.$lc->journalable->projectPurchase->supplier->name : '',
					'project' => $lc->journalable ? $lc->journalable->project_id : '',
					'name'    => $lc->coa->name,
					'debit'   => $debit,
					'credit'  => $credit
				];
			}
        }

        $data = [
            'title'   	=> 'Outstanding A/P',
			'filter'  	=> $filter,
			'resultsby' => $resultsby,
			'resultjkt' => $resultjkt,
            'content' 	=> 'admin.report.finance.outstanding_a_p'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }
	
	public function agingReceivable(Request $request) 
    {
		$filter = $request->filter ? $request->filter : date('Y-m');
		
		$resultsby   = [];
		$resultjkt   = [];
        $code     = [28,29];
        $list_journal = Journal::whereIn('coa_id', $code)
			->whereYear('created_at', date('Y', strtotime($filter)))
            ->whereMonth('created_at', date('m', strtotime($filter)))
			->get();
		
		foreach($list_journal as $lc) {
			$debit = 0;
			$credit = 0;
			if($lc->type == '1'){
				$debit = $lc->nominal;
			}elseif($lc->type == '2'){
				$credit = $lc->nominal;
			}
			
			if($lc->coa_id == 28){
				$resultsby[] = [
					'id'      => $lc->id,
					'no'      => $lc->coa->code,
					'code' 	  => $lc->journalable ? $lc->journalable->code : '',
					'info'    => $lc->journalable ? $lc->journalable->description.' by '.$lc->journalable->projectSale->project->customer->name.' Term '.$lc->journalable->projectSale->project->paymentTerm() : '',
					'project' => $lc->journalable ? $lc->journalable->project_id : '',
					'date' 	  => date('Y/m/d',strtotime($lc->created_at)),
					'name'    => $lc->coa->name,
					'debit'   => $debit,
					'credit'  => $credit
				];
			}elseif($lc->coa_id == 29){
				$resultjkt[] = [
					'id'      => $lc->id,
					'no'      => $lc->coa->code,
					'code' 	  => $lc->journalable ? $lc->journalable->code : '',
					'info'    => $lc->journalable ? $lc->journalable->description.' by '.$lc->journalable->projectSale->project->customer->name.' Term '.$lc->journalable->projectSale->project->paymentTerm() : '',
					'project' => $lc->journalable ? $lc->journalable->project_id : '',
					'date' 	  => date('F j, Y',strtotime($lc->created_at)),
					'name'    => $lc->coa->name,
					'debit'   => $debit,
					'credit'  => $credit
				];
			}
        }
		
		$data = [
            'title'   	=> 'Aging Receivable',
			'filter'  	=> $filter,
			'resultsby' => $resultsby,
			'resultjkt' => $resultjkt,
            'content' 	=> 'admin.report.accounting.aging_receivable'
        ];

        return view('admin.layouts.index', ['data' => $data]);
	}
	
	public function agingPayable(Request $request) 
    {
		$filter = $request->filter ? $request->filter : date('Y-m');
		
		$resultsby   = [];
		$resultjkt   = [];
        $code     = [78,79];
        $list_journal = Journal::whereIn('coa_id', $code)
			->whereYear('created_at', date('Y', strtotime($filter)))
            ->whereMonth('created_at', date('m', strtotime($filter)))
			->get();
		
		foreach($list_journal as $lc) {
			$debit = 0;
			$credit = 0;
			if($lc->type == '1'){
				$debit = $lc->nominal;
			}elseif($lc->type == '2'){
				$credit = $lc->nominal;
			}
			
			if($lc->coa_id == 78){
				$resultsby[] = [
					'id'      => $lc->id,
					'no'      => $lc->coa->code,
					'code' 	  => $lc->journalable ? $lc->journalable->code : '',
					'info'    => $lc->journalable ? $lc->journalable->description.' to '.$lc->journalable->projectPurchase->supplier->name : '',
					'project' => $lc->journalable ? $lc->journalable->project_id : '',
					'date' 	  => date('Y/m/d',strtotime($lc->created_at)),
					'name'    => $lc->coa->name,
					'debit'   => $debit,
					'credit'  => $credit
				];
			}elseif($lc->coa_id == 79){
				$resultjkt[] = [
					'id'      => $lc->id,
					'no'      => $lc->coa->code,
					'code' 	  => $lc->journalable ? $lc->journalable->code : '',
					'info'    => $lc->journalable ? $lc->journalable->description.' to '.$lc->journalable->projectPurchase->supplier->name : '',
					'project' => $lc->journalable ? $lc->journalable->project_id : '',
					'date' 	  => date('F j, Y',strtotime($lc->created_at)),
					'name'    => $lc->coa->name,
					'debit'   => $debit,
					'credit'  => $credit
				];
			}
        }
		
		$data = [
            'title'   	=> 'Aging Payable',
			'filter'  	=> $filter,
			'resultsby' => $resultsby,
			'resultjkt' => $resultjkt,
            'content' 	=> 'admin.report.accounting.aging_payable'
        ];

        return view('admin.layouts.index', ['data' => $data]);
	}
}
