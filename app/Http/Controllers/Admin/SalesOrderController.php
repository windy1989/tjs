<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Order;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\UserRole;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\OrderShipping;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller {
    
    public function index()
    {
        $data = [
            'title'    => 'Manage Sales Order',
            'customer' => Customer::whereNotNull('verification')->get(),
            'content'  => 'admin.manage.sales_order'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'customer_id',
            'sales_order',
            'grandtotal',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Order::whereNotNull('sales_order')
            ->where('type', 1)
            ->count();
        
        $query_data = Order::whereNotNull('sales_order')
            ->where('type', 1)
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('customer', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhere('sales_order', 'like', "%$search%");
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

        $total_filtered = Order::whereNotNull('sales_order')
            ->where('type', 1)
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('customer', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhere('sales_order', 'like', "%$search%");
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
                if($val->invoice) {
                    $btn = '<a href="' . url('admin/manage/sales_order/detail/' . $val->id) . '" class="btn bg-success btn-sm"><i class="icon-check"></i> View</a>';
                } else {
                    $btn = '<a href="' . url('admin/manage/sales_order/detail/' . $val->id) . '" class="btn bg-info btn-sm"><i class="icon-info22"></i> Process</a>';
                }
                
                $response['data'][] = [
                    $nomor,
                    $val->customer->name,
                    $val->sales_order,
                    'Rp ' . number_format($val->grandtotal, 0, ',', '.'),
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

    public function getDelivery(Request $request)
    {
        $data     = [];
        $city_id  = $request->city_id;
        $weight   = (double)$request->weight;
        $delivery = Delivery::where('destination_id', $city_id)
            ->where('capacity', '>=', $weight)
            ->orderBy('price_per_kg', 'asc')
            ->groupBy('transport_id')
            ->get();

        foreach($delivery as $d) {
            $data[] = [
                'id'             => $d->id,
                'price'          => 'Rp ' . number_format($d->price_per_kg * $weight, '0', ',', '.'),
                'transport_name' => $d->transport->fleet
            ];
        }

        return response()->json($data);
    }

    public function detail(Request $request, $id) 
    {
        $order = Order::find($id);
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'target_price'       => 'required|array',
                'target_price.*'     => 'required|numeric',
                'partial_delivery'   => 'required|array',
                'partial_delivery.*' => 'required',
                'receiver_name'      => 'required',
                'email'              => 'required|email',
                'phone'              => 'required|min:9|numeric',
                'city_id'            => 'required',
                'address'            => 'required',
                'delivery_id'        => 'required'
            ], [
                'target_price.required'       => 'Target price cannot be a empty.',
                'target_price.array'          => 'Target price must be array.',
                'target_price.*.required'     => 'Target price nothing can be empty.',
                'target_price.*.numeric'      => 'Target price must be number.',
                'partial_delivery.required'   => 'Partial delivery cannot be a empty.',
                'partial_delivery.array'      => 'Partial delivery must be array.',
                'partial_delivery.*.required' => 'Partial delivery nothing can be empty.',
                'receiver_name.required'      => 'Receiver name cannot be empty.',
                'email.required'              => 'Email cannot be empty.',
                'email.email'                 => 'Email not valid.',
                'phone.required'              => 'Phone cannot be empty',
                'phone.min'                   => 'Phone must be at least 9 characters long',
                'phone.numeric'               => 'Phone must be number',
                'city_id.required'            => 'Please select a city.',
                'address.required'            => 'Address cannot be empty.',
                'delivery_id.required'        => 'Please select a fleet.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $approval_manager  = 0;
                $approval_director = 0;
                $total_weight      = 0;

                foreach($request->order_detail_id as $key => $odi) {
                    $order_detail            = OrderDetail::find($odi);
                    $total_weight           += $order_detail->product->type->weight * $order_detail->qty;
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
                    $order->update([
                        'invoice' => Order::generateCode('CH', 'invoice')
                    ]);

                    $flash_success = 'Order <b class="font-italic">' . $order->sales_order .  '</b> is already in the purchase order';
                }

                $delivery     = Delivery::find($request->delivery_id);
                $shipping_fee = $delivery->price_per_kg * $total_weight;
                $order->update([
                    'subtotal'   => $order->orderDetail->sum('target_price'),
                    'shipping'   => $shipping_fee,
                    'grandtotal' => $order->orderDetail->sum('target_price') + $shipping_fee
                ]);

                OrderShipping::create([
                    'order_id'      => $order->id,
                    'city_id'       => $request->city_id,
                    'delivery_id'   => $request->delivery_id,
                    'receiver_name' => $request->receiver_name,
                    'email'         => $request->email,
                    'phone'         => $request->phone,
                    'address'       => $request->address
                ]);

                return redirect('admin/manage/sales_order')->with(['success' => $flash_success]);
            }
        }

        $data  = [
            'title'   => 'Sales Order Detail',
            'order'   => $order,
            'city'    => City::oldest('name')->get(),
            'content' => 'admin.manage.sales_order_detail'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
