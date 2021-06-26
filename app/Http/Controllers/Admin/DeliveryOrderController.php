<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderDelivery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DeliveryOrderController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Manage Delivery Order',
            'order'   => Order::whereIn('status', [2, 3, 4])->get(),
            'content' => 'admin.manage.delivery_order'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'delivery_order',
            'order_id',
            'status',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = OrderDelivery::count();
        
        $query_data = OrderDelivery::where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('order', function($query) use ($search) {
                            $query->where('number', 'like', "%$search%");
                        })
                        ->orWhere('delivery_order', 'like', "%$search%");
                }   
                
                if($request->order_id) {
                    $query->where('order_id', $request->order_id);
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

        $total_filtered = OrderDelivery::where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('order', function($query) use ($search) {
                            $query->where('number', 'like', "%$search%");
                        })
                        ->orWhere('delivery_order', 'like', "%$search%");
                }   
                
                if($request->order_id) {
                    $query->where('order_id', $request->order_id);
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
                if($val->order->status == 4) {
                    $btn = '';
                } else {
                    $btn = '<button type="button" class="btn bg-danger btn-sm" data-popup="tooltip" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>';
                }

                $response['data'][] = [
                    $nomor,
                    $val->delivery_order,
                    $val->order->number,
                    $val->order->status(),
                    date('d F Y', strtotime($val->created_at)),
                    '
                        <button type="button" class="btn bg-info btn-sm" data-popup="tooltip" title="Information" onclick="information(' . $val->id . ')"><i class="icon-info22"></i></button>
                    ' . 
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

    public function getDataOrder(Request $request)
    {
        $order        = Order::find($request->order_id);
        $order_detail = [];

        foreach($order->orderDetail as $od) {
            $order_detail[] = [
                'image'   => $od->product->type->image(),
                'product' => $od->product->code(),
                'qty'     => $od->qty
            ];
        }

        return response()->json([
            'order_detail'   => $order_detail,
            'order_shipping' => [
                'name'    => $order->orderShipping->receiver_name,
                'email'   => $order->orderShipping->email,
                'phone'   => $order->orderShipping->phone,
                'city'    => $order->orderShipping->city->name,
                'fleet'   => $order->orderShipping->delivery->transport->fleet,
                'vendor'  => $order->orderShipping->delivery->vendor->name,
                'address' => $order->orderShipping->address
            ]
        ]);
    }

    public function create(Request $request)
    {
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'order_id' => 'required'
            ], [
                'order_id.required' => 'Please select a order.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query = OrderDelivery::create([
                    'order_id'       => $request->order_id,
                    'delivery_order' => OrderDelivery::generateCode()
                ]);

                if($query) {
                    Order::find($request->order_id)->update(['status' => 3]);
                    return redirect()->back()->with(['success' => 'Data added successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to added.']);
                }
            }
        } else {
            $order = Order::where('status', 2)
                ->whereNotNull('purchase_order')
                ->whereHas('orderDetail', function($query) {
                    $query->whereDate('partial_delivery', '<=', date('Y-m-d'))
                        ->whereNotExists(function($query) {
                            $query->selectRaw(1)
                                ->from('order_deliveries')
                                ->whereColumn('order_deliveries.order_id', 'orders.id');
                        });
                })
                ->oldest('created_at')
                ->get();

            $data = [
                'title'   => 'Create Delivery Order',
                'order'   => $order,
                'content' => 'admin.manage.delivery_order_create'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function information(Request $request)
    {
        $order_delivery = OrderDelivery::find($request->id);
        $order_detail   = [];

        foreach($order_delivery->order->orderDetail as $od) {
            $order_detail[] = [
                'image'   => $od->product->type->image(),
                'product' => $od->product->code(),
                'qty'     => $od->qty
            ];
        }

        return response()->json([
            'order_delivery' => ['code' => $order_delivery->delivery_order, 'status' => $order_delivery->order->status()],
            'order_detail'   => $order_detail,
            'order_shipping' => [
                'name'    => $order_delivery->order->orderShipping->receiver_name,
                'email'   => $order_delivery->order->orderShipping->email,
                'phone'   => $order_delivery->order->orderShipping->phone,
                'city'    => $order_delivery->order->orderShipping->city->name,
                'fleet'   => $order_delivery->order->orderShipping->delivery->transport->fleet,
                'vendor'  => $order_delivery->order->orderShipping->delivery->vendor->name,
                'address' => $order_delivery->order->orderShipping->address
            ]
        ]);
    }

    public function destroy(Request $request) 
    {
        $data  = OrderDelivery::find($request->id);
        $order = $data->order;

        if($data->delete()) {
            Order::find($order->id)->update(['status' => 2]);
            $response = [
                'status'  => 200,
                'message' => 'Data deleted successfully.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Data failed to delete.'
            ];
        }

        return response()->json($response);
    }

}
