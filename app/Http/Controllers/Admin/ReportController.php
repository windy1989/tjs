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
        // dd(SMB::reportProfitLoss($filter));
        $data   = [
            'title'       => 'Report Profit & Loss',
            'profit_loss' => SMB::reportProfitLoss($filter),
            'filter'      => $filter,
            'content'     => 'admin.report.profit_loss'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }
    
}
