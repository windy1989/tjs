<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Illuminate\Http\Request;
use App\Exports\StocksExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class StockController extends Controller {

    public function index(Request $request)
    {

        $per_page = 10;
        $page     = $request->has('page') ? $request->page: 1;
        $stock    = json_decode(Http::retry(3, 100)->post(env('VENTURA') . 'ventura/item/stock', [
            'tipe_item' => $request->search,
            'page'      => $page,
            'per_page'  => 10
        ]));

        $result       = $stock->result->data;
        $total_result = $stock->result->total_data;
        $items        = new LengthAwarePaginator($result, $total_result, $per_page, $page, [
            'path'  => $request->url(),
            'query' => $request->query()
        ]);

        $data = [
            'title'   => 'Stock',
            'search'  => $request->search,
            'items'   => $items,
            'content' => 'admin.master_data.product.stock'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }
	
	public function export(Request $request){
		$search = $request->search ? $request->search : '';
		
		return Excel::download(new StocksExport($search), 'stocks.xlsx');
	}
	
	public function print(Request $request)
    {
		$search = $request->search ? $request->search : '';
		$page     = $request->has('page') ? $request->page: 1;
		
		$stock = json_decode(Http::retry(3, 100)->post(env('VENTURA') . 'ventura/item/stock', [
            'tipe_item' => $search,
			'page'      => $page,
            'per_page'  => 10
        ]));
		
		$result = $stock->result;

		if(!$result) {
			abort(404);
		}
		
		$pdf = PDF::loadView('admin.pdf.master_data.stock', [
				'result' => $result
			],
			[],
			[ 
			  'format' => 'A4-P',
			  'orientation' => 'P'
			]
		);

        return $pdf->stream('stock_report.pdf');
    }
}
