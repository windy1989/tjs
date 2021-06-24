<?php

namespace App\Http\Controllers\Admin;

use App\Helper\SMB;
use App\Models\Coa;
use App\Models\Journal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller {

    public function balanceSheet(Request $request) 
    {
        $filter = $request->filter ? $request->filter : date('Y-m');
        $data   = [
            'title'         => 'Report Balance Sheet',
            'balance_sheet' => SMB::reportBalanceSheet($filter),
            'filter'        => $filter,
            'content'       => 'admin.report.balance_sheet'
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
            'title'       => 'Report Profit & Loss',
            'profit_loss' => SMB::reportProfitLoss($filter),
            'filter'      => $filter,
            'total'       => $total,
            'content'     => 'admin.report.profit_loss'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function ledger() 
    {
        $data   = [
            'title'   => 'Report Ledger',
            'coa'     => Coa::where('status', 1)->get(),
            'content' => 'admin.report.ledger'
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

        $total_data = Coa::has('journal')
            ->where('status', 1)
            ->count();
        
        $query_data = Coa::has('journal')
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }     

                if($request->coa_id) {
                    $query->where('id', $request->coa_id);
                }
                
                if($request->start_date && $request->finsih_date) {
                    $query->whereHas('journal', function($query) use ($request) {
                            $query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->start_date)))
                                ->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->finish_date)));
                        });

                        dd(date('Y-m-t', strtotime($request->finish_date)));
                } else if($request->start_date) {
                    $query->whereHas('journal', function($query) use ($request) {
                            $query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->start_date)))
                                ->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->start_date)));
                        });
                } else if($request->finish_date) {
                    $query->whereHas('journal', function($query) use ($request) {
                            $query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->finish_date)))
                                ->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->finish_date)));
                        });
                }
            })
            ->where('status', 1)
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Coa::has('journal')
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }     

                if($request->coa_id) {
                    $query->where('id', $request->coa_id);
                }
                
                if($request->start_date && $request->finsih_date) {
                    $query->whereHas('journal', function($query) use ($request) {
                            $query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->start_date)))
                                ->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->finish_date)));
                        });
                } else if($request->start_date) {
                    $query->whereHas('journal', function($query) use ($request) {
                            $query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->start_date)))
                                ->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->start_date)));
                        });
                } else if($request->finish_date) {
                    $query->whereHas('journal', function($query) use ($request) {
                            $query->whereDate('created_at', '>=', date('Y-m-01', strtotime($request->finish_date)))
                                ->whereDate('created_at', '<=', date('Y-m-t', strtotime($request->finish_date)));
                        });
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

                $beginning_debit  = $val->journalDebit()->whereRaw($beginning_where_raw)->sum('nominal');
                $beginning_credit = $val->journalCredit()->whereRaw($beginning_where_raw)->sum('nominal');
                if(!$request->start_date && !$request->finish_date) {
                    $beginning_total = 0;
                } else {
                    $beginning_total = $beginning_debit - $beginning_credit;
                }

                $ending_debit  = $val->journalDebit()->whereRaw($ending_where_raw)->sum('nominal');
                $ending_credit = $val->journalCredit()->whereRaw($ending_where_raw)->sum('nominal');
                $ending_total  = $ending_debit - $ending_credit;

                $response['data'][] = [
                    '<span class="pointer-element badge badge-success" data-id="' . $val->id . '"><i class="icon-plus3"></i></span>',
                    $nomor,
                    $val->name,
                    number_format($beginning_total),
                    number_format($ending_debit),
                    number_format($ending_credit),
                    number_format($beginning_total + $ending_total)
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
        $string  = '<div class="list-feed">';
        $journal = Journal::where(function($query) use ($request) {
                $query->where('debit', $request->id)->orWhere('credit', $request->id);
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

        foreach($journal as $j) {
            $check_position = Journal::where('id', $j->id);
            if($request->id == $j->debit) {
                $type = '<span class="text-dark font-weight-bold">Debit</span>';
            } else {
                $type = '<span class="text-dark font-weight-bold">Credit</span>';
            }

            if($j->journalable_type == 'cash_banks') {
                $code        = 'Code : ' . '<span class="font-italic">' . $j->journalable->code . '</span>';
                $description = $j->journalable->description;
            }

            $string .= '
                <div class="list-feed-item">
                    <div class="text-muted">' . date('d-m-Y', strtotime($j->created_at)) . ' | ' . $type . '</div>
                    <div>' . $code . '</div>
                    <div>' . $description . '</div>
                    <div><span class="font-weight-bold">' . number_format($j->nominal) . '</span></div>
                </div>
            ';
        }

        $string .= '</div>';

        if($journal->count() > 0) {
            return response()->json($string);
        } else {
            return response()->json('<p class="font-weight-bold font-italic mt-2">Order Not Found</p>');
        }
    }
    
}
