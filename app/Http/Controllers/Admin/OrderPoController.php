<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Brand;
use App\Models\OrderPo;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\OrderDelivery;
use App\Http\Controllers\Controller;

class OrderPoController extends Controller {

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
            'order_id',
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

        $total_data = OrderPo::count();
        
        $query_data = OrderPo::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where('purchase_order', 'like', "%$search%")
                        ->orWhereHas('order', function($query) use ($search) {
                            $query->where('number', 'like', "%$search%");
                        });
                }   

                if($request->status) {
                    $query->where('status', $request->status);
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

        $total_filtered = OrderPo::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where('purchase_order', 'like', "%$search%")
                        ->orWhereHas('order', function($query) use ($search) {
                            $query->where('number', 'like', "%$search%");
                        });
                }   

                if($request->status) {
                    $query->where('status', $request->status);
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
                $bottom_price = $val->order->orderDetail->sum('bottom_price') * $val->order->orderDetail->sum('qty');
                $grandtotal   = $bottom_price + $val->order->shipping;

                if($val->status == 1) {
                    $btn = '<a href="' . url('admin/manage/purchase_order/detail/' . $val->id) . '" class="btn bg-info btn-sm"><i class="icon-info22"></i> Process</a>';
                } else {
                    $btn = '<a href="' .url('admin/manage/purchase_order/detail/' . $val->id) . '" class="btn bg-success btn-sm"><i class="icon-check"></i> View</a>';
                }

                $response['data'][] = [
                    $nomor,
                    $val->order->number,
                    'Karya Modern',
                    $val->purchase_order,
                    'Rp ' . number_format($grandtotal, 0, ',', '.'),
                    $val->status(),
                    date('d F Y', strtotime($val->created_at)),
                    $btn
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
        $purchase_order = OrderPo::find($id);
        if($request->has('_token') && session()->token() == $request->_token) {
            $purchase_order->update([
                'status' => $request->has('status') ? $request->status : 1
            ]);

            if($request->has('status')) {
                OrderDelivery::create([
                    'order_id'       => $purchase_order->order_id,
                    'delivery_order' => OrderDelivery::generateCode()
                ]);

                Order::find($purchase_order->order_id)->update(['status' => 3]);
            }

            foreach($request->order_detail_id as $key => $odi) {
                OrderDetail::find($odi)->update([
                    'bottom_price' => $request->order_detail_bottom_price[$key]
                ]);
            }

            return redirect()->back()->with(['success' => 'Data has been processed!']);
        }

        $data = [
            'title'          => 'Purchase Order Detail',
            'purchase_order' => $purchase_order,
            'brand'          => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get(),
            'content'        => 'admin.manage.purchase_order_detail'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function print($id)
    {
        $purchase_order = OrderPo::find($id);
        $pdf            = PDF::loadView('admin.pdf.purchase_order', [
            'purchase_order' => $purchase_order,
            'brand'          => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get()
        ]);

        return $pdf->stream('Purchase Order ' . str_replace('/', '-', $purchase_order->purchase_order) . '.pdf');
    }

}
