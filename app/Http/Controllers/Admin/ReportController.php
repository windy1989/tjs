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
            'total_sale_actual_current' => 0,
            'total_sale_budget' => 0,
            'total_sale_variance' => 0
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
