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

        $total_data = Coa::where(function($query) {
                $query->has('journalDebit')
                    ->orHas('journalCredit');
            })
            ->where('status', 1)
            ->count();
        
        $query_data = Coa::where(function($query) {
                $query->has('journalDebit')
                    ->orHas('journalCredit');
            })
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }     

                if($request->coa_id) {
                    $query->where('id', $request->coa_id);
                }
                
                // $query->where(function($query) use ($request) {
                //     $query->whereHas('journalDebit', function($query) use ($request) {
                //             $query->whereMonth('created_at', date('m', strtotime($request->date)))
                //                 ->whereYear('created_at', date('Y', strtotime($request->date)));
                //         })
                //         ->orWhereHas('journalCredit', function($query) use ($request) {
                //             $query->whereMonth('created_at', date('m', strtotime($request->date)))
                //                 ->whereYear('created_at', date('Y', strtotime($request->date)));
                //         });
                // });
            })
            ->where('status', 1)
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Coa::where(function($query) {
                $query->has('journalDebit')
                    ->orHas('journalCredit');
            })
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }     

                if($request->coa_id) {
                    $query->where('id', $request->coa_id);
                }
                
                // $query->where(function($query) use ($request) {
                //     $query->whereHas('journalDebit', function($query) use ($request) {
                //             $query->whereMonth('created_at', date('m', strtotime($request->date)))
                //                 ->whereYear('created_at', date('Y', strtotime($request->date)));
                //         })
                //         ->orWhereHas('journalCredit', function($query) use ($request) {
                //             $query->whereMonth('created_at', date('m', strtotime($request->date)))
                //                 ->whereYear('created_at', date('Y', strtotime($request->date)));
                //         });
                // });
            })
            ->where('status', 1)
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $month = date('m', strtotime($request->date));
                $year  = date('Y', strtotime($request->date));

                $beginning_where_raw = "MONTH(created_at) < $month AND YEAR(created_at) = $year";
                $beginning_debit     = $val->journalDebit()->whereRaw($beginning_where_raw)->sum('nominal');
                $beginning_credit    = $val->journalCredit()->whereRaw($beginning_where_raw)->sum('nominal');
                $beginning_total     = $beginning_debit - $beginning_credit;
                if($beginning_total == 0) {
                    $beginning_string = '<span class="text-primary font-weight-bold">0</span>';
                } else if($beginning_total >= 0) {
                    $beginning_string = '<span class="text-success font-weight-bold">' . number_format($beginning_total) . '</span>';
                } else {
                    $beginning_string = '<span class="text-danger font-weight-bold">' . number_format($beginning_total) . '</span>';
                }

                $ending_where_raw = "MONTH(created_at) <= $month AND YEAR(created_at) = $year";
                $ending_debit     = $val->journalDebit()->whereRaw($ending_where_raw)->sum('nominal');
                $ending_credit    = $val->journalCredit()->whereRaw($ending_where_raw)->sum('nominal');
                $ending_total     = $ending_debit - $ending_credit;
                if($ending_total == 0) {
                    $ending_string = '<span class="text-primary font-weight-bold">0</span>';
                } else if($ending_total >= 0) {
                    $ending_string = '<span class="text-success font-weight-bold">' . number_format($ending_total) . '</span>';
                } else {
                    $ending_string = '<span class="text-danger font-weight-bold">' . number_format($ending_total) . '</span>';
                }

                $response['data'][] = [
                    '<span class="pointer-element badge badge-success" data-id="' . $val->id . '"><i class="icon-plus3"></i></span>',
                    $nomor,
                    date('F Y', strtotime($request->date)),
                    '<b>[' . $val->code . ']</b> ' . $val->name,
                    $beginning_string,
                    '<span class="text-success font-weight-bold">' . number_format($ending_debit) . '</span>',
                    '<span class="text-danger font-weight-bold">' . number_format($ending_credit) . '</span>',
                    $ending_string
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
                $query->whereYear('created_at', date('Y', strtotime($request->date)))
                    ->whereMonth('created_at', '<=', date('m', strtotime($request->date)));
            })
            ->oldest('created_at')
            ->get();

        foreach($journal as $j) {
            $check_position = Journal::where('id', $j->id);
            if($request->id == $j->debit) {
                $type    = '<span class="text-success font-weight-bold font-italic">Debit</span>';
                $nominal = '<span class="text-success font-weight-bold">' . number_format($j->nominal) . '</span>';
            } else {
                $type    = '<span class="text-danger font-weight-bold font-italic">Credit</span>';
                $nominal = '<span class="text-danger font-weight-bold">' . number_format($j->nominal) . '</span>';
            }

            $string .= '
                <div class="list-feed-item">
                    <div class="text-muted">' . date('d-m-Y', strtotime($j->created_at)) . ' | ' . $type . '</div>
                    <div>' . $j->description . '</div>
                    <div>' . $nominal . '</div>
                </div>
            ';
        }

        $string .= '</div>';

        return response()->json($string);
    }
    
}
