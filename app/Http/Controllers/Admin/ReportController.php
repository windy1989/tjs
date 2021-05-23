<?php

namespace App\Http\Controllers\Admin;

use App\Helper\SMB;
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
            'cogs_actual_percent_current'   => 0,
            'cogs_actual_percent_last'      => 0,
            'cogs_budget_percent'           => 0,
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
    
}
