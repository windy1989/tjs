<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Brand;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Manage Purchase Order',
            'content' => 'admin.manage.purchase_order'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'vendor',
            'purchase_order',
            'grandtotal',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Order::whereNotNull('purchase_order')
            ->count();
        
        $query_data = Order::whereNotNull('purchase_order')
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where('purchase_order', 'like', "%$search%");
                }   

                if($request->start_date && $request->finish_date) {
                    $query->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->whereDate('created_at', $request->start_date);
                } else if($request->finish_date) {
                    $query->whereDate('created_at', $request->finish_date);
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Order::whereNotNull('purchase_order')
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where('purchase_order', 'like', "%$search%");
                }   

                if($request->start_date && $request->finish_date) {
                    $query->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->whereDate('created_at', $request->start_date);
                } else if($request->finish_date) {
                    $query->whereDate('created_at', $request->finish_date);
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $grandtotal = ($val->orderDetail->sum('bottom_price') * $val->orderDetail->sum('qty')) + $val->shipping;

                $response['data'][] = [
                    $nomor,
                    'Karya Modern',
                    $val->purchase_order,
                    'Rp ' . number_format($grandtotal, 0, ',', '.'),
                    date('d F Y', strtotime($val->created_at)),
                    '
                        <a href="' . url('admin/manage/purchase_order/detail/' . $val->id) . '" class="btn bg-info btn-sm"><i class="icon-info22"></i> Detail</a>
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

    public function detail(Request $request, $id) 
    {
        $data = [
            'title'   => 'Purchase Order Detail',
            'order'   => Order::find($id),
            'brand'   => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get(),
            'content' => 'admin.manage.purchase_order_detail'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function print($id)
    {
        $order = Order::find($id);
        $pdf   = PDF::loadView('admin.pdf.purchase_order', [
            'order' => $order,
            'brand' => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get()
        ]);

        return $pdf->stream('Purchase Order ' . str_replace('/', '-', $order->purchase_order) . '.pdf');
    }

}
