<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller {

    public function index()
    {
        $data = [
            'title'    => 'Manage Invoice',
            'customer' => Customer::whereNotNull('verification')->get(),
            'content'  => 'admin.manage.invoice'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'customer_id',
            'invoice',
            'payment',
            'grandtotal',
            'status',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Order::whereNotNull('invoice')
            ->where('type', 1)
            ->count();
        
        $query_data = Order::whereNotNull('invoice')
            ->where('type', 1)
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('customer', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhere('invoice', 'like', "%$search%");
                }   
                
                if($request->customer_id) {
                    $query->where('customer_id', $request->customer_id);
                }

                if($request->nominal) {
                    if($request->nominal == 1) {
                        $query->where('grandtotal', '<=', 999999);
                    } else if($request->nominal == 2) {
                        $query->where(function($query) {
                                $query->where('grandtotal', '>', 999999)
                                    ->where('grandtotal', '<=', 999999999);
                            });
                    } else if($request->nominal == 3) {
                        $query->where(function($query) {
                                $query->where('grandtotal', '>', 999999999)
                                    ->where('grandtotal', '<=', 999999999999);
                            });
                    }
                }

                if($request->status) {
                    if($request->status == 'unpaid') {
                        $query->where('payment', 0)->orWhereNull('payment');
                    } else if($request->status == 'down_payment') {
                        $query->whereRaw('payment > 0 AND payment < grandtotal');
                    } else {
                        $query->whereRaw('payment >= grandtotal');
                    }
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

        $total_filtered = Order::whereNotNull('invoice')
            ->where('type', 1)
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('customer', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhere('invoice', 'like', "%$search%");
                }   
                
                if($request->customer_id) {
                    $query->where('customer_id', $request->customer_id);
                }

                if($request->nominal) {
                    if($request->nominal == 1) {
                        $query->where('grandtotal', '<=', 999999);
                    } else if($request->nominal == 2) {
                        $query->where(function($query) {
                                $query->where('grandtotal', '>', 999999)
                                    ->where('grandtotal', '<=', 999999999);
                            });
                    } else if($request->nominal == 3) {
                        $query->where(function($query) {
                                $query->where('grandtotal', '>', 999999999)
                                    ->where('grandtotal', '<=', 999999999999);
                            });
                    }
                }

                if($request->status) {
                    if($request->status == 'unpaid') {
                        $query->where('payment', 0)->orWhereNull('payment');
                    } else if($request->status == 'down_payment') {
                        $query->whereRaw('payment > 0 AND payment < grandtotal');
                    } else {
                        $query->whereRaw('payment >= grandtotal');
                    }
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
                if($val->purchase_order) {
                    $btn = '<a href="' . url('admin/manage/invoice/detail/' . $val->id) . '" class="btn bg-success btn-sm"><i class="icon-check"></i> View</a>';
                } else {
                    $btn = '<a href="' . url('admin/manage/invoice/detail/' . $val->id) . '" class="btn bg-info btn-sm"><i class="icon-info22"></i> Process</a>';
                }

                if($val->payment == 0 || $val->payment == null) {
                    $status = 'Unpaid';
                } else if($val->payment < $val->grandtotal) {
                    $status = 'Down Payment';
                } else {
                    $status = 'Full Payment';
                }

                $response['data'][] = [
                    $nomor,
                    $val->customer->name,
                    $val->invoice,
                    'Rp ' . number_format($val->payment, 0, ',', '.'),
                    'Rp ' . number_format($val->grandtotal, 0, ',', '.'),
                    $status,
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
        $order = Order::find($id);
        if($request->has('_token') && session()->token() == $request->_token) {
            if($request->payment) {
                $status = 2;
                OrderPayment::create([
                    'order_id' => $order->id,
                    'method'   => 'Cash',
                    'channel'  => 'Smart Marble'
                ]);
            } else {
                $status = 1;
            }

            $order->update([
                'payment' => $request->payment,
                'status'  => $status
            ]);

            return redirect()->back()->with(['success' => 'Data has been processed!']);
        }

        $data  = [
            'title'   => 'Invoice Detail',
            'brand'   => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get(),
            'order'   => $order,
            'content' => 'admin.manage.invoice_detail'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function print($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf.invoice', ['order' => $order]);
        return $pdf->stream('document.pdf');
    }

}
