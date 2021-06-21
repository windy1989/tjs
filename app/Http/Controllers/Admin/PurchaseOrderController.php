<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller {

    public function index()
    {
        $data = [
            'title'    => 'Manage Purchase Order',
            'customer' => Customer::whereNotNull('verification')->get(),
            'content'  => 'admin.manage.purchase_order'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'customer_id',
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
                    $query->whereHas('customer', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhere('purchase_order', 'like', "%$search%");
                }   
                
                if($request->customer_id) {
                    $query->where('customer_id', $request->customer_id);
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
                    $query->whereHas('customer', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhere('purchase_order', 'like', "%$search%");
                }   
                
                if($request->customer_id) {
                    $query->where('customer_id', $request->customer_id);
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
                $response['data'][] = [
                    $nomor,
                    $val->customer->name,
                    $val->purchase_order,
                    'Rp ' . number_format($val->grandtotal, 0, ',', '.'),
                    date('d F Y', strtotime($val->created_at)),
                    '
                        <a href="' . url('admin/manage/purchase_order/detail/' . $val->id) . '" class="btn bg-info btn-sm"><i class="icon-info22"></i> Process</a>
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
        $order = Order::find($id);
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'target_price'       => 'required|array',
                'target_price.*'     => 'required|numeric',
                'partial_delivery'   => 'required|array',
                'partial_delivery.*' => 'required'
            ], [
                'target_price.required'       => 'Target price cannot be a empty.',
                'target_price.array'          => 'Target price must be array.',
                'target_price.*.required'     => 'Target price nothing can be empty.',
                'target_price.*.numeric'      => 'Target price must be number.',
                'partial_delivery.required'   => 'Partial delivery cannot be a empty.',
                'partial_delivery.array'      => 'Partial delivery must be array.',
                'partial_delivery.*.required' => 'Partial delivery nothing can be empty.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $approval_manager  = 0;
                $approval_director = 0;

                foreach($request->order_detail_id as $key => $odi) {
                    $order_detail            = OrderDetail::find($odi);
                    $discount_manager        = $order_detail->product->pricingPolicy ? $order_detail->product->pricingPolicy->discount_retail_manager : 0;
                    $discount_director       = $order_detail->product->pricingPolicy ?  $order_detail->product->pricingPolicy->discount_retail_director : 0;
                    $total_discount_manager  = $order_detail->total - ($discount_manager * $order_detail->qty);
                    $total_discount_director = $order_detail->total - ($discount_director * $order_detail->qty);

                    if($request->target_price[$key] < $total_discount_manager) {
                        $approval_manager += 1;
                    } else {
                        $approval_director += 1;
                    }

                    OrderDetail::find($odi)->update([
                        'target_price'     => $request->target_price[$key],
                        'partial_delivery' => $request->partial_delivery[$key]
                    ]);
                } 

                if($request->approval) {
                    if($approval_director > 0) {
                        $role = 1;
                    } else {
                        $role = 5;
                    }

                    $user_id = UserRole::select('user_id')->where('role', $role)->get();
                    foreach($user_id as $ui) {
                        Approval::create([
                            'user_id'           => $ui->user_id,
                            'approvalable_type' => 'orders',
                            'approvalable_id'   => $order->id,
                            'reference'         => session('bo_id'),
                            'status'            => 1
                        ]);
                    }

                    $flash_success = 'Order is under approval';
                } else {
                    $flash_success = 'Order <b class="font-italic">' . $order->sales_order .  '</b> is already in the purchase order';
                }

                return redirect('admin/manage/sales_order')->with(['success' => $flash_success]);
            }
        }

        $data  = [
            'title'   => 'Purchase Order Detail',
            'order'   => $order,
            'content' => 'admin.manage.purchase_order_detail'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function print($id)
    {
        $order = Order::find($id);
        $pdf   = PDF::loadView('admin.pdf.purchase_order', ['order' => $order]);

        return $pdf->stream($order->purchase_order . '.pdf', ['Attachment' => true]);
    }

}
