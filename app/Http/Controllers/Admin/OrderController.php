<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller {
    
    public function index()
    {
        $data = [
            'title'    => 'Manage Order',
            'customer' => Customer::whereNotNull('verification')->get(),
            'content'  => 'admin.manage.order'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'customer_id',
            'code',
            'grandtotal',
            'created_at',
            'type',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Order::count();
        
        $query_data = Order::where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('customer', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
                                })
                            ->orWhere('code', 'like', "%$search%");
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

                if($request->type) {
                    $query->where('type', $request->type);
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

        $total_filtered = Order::where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('customer', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
                                })
                            ->orWhere('code', 'like', "%$search%");
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

                if($request->type) {
                    $query->where('type', $request->type);
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
                $response['data'][] = [
                    $nomor,
                    $val->customer->name,
                    $val->code,
                    'Rp ' . number_format($val->grandtotal, 0, ',', '.'),
                    date('d F Y', strtotime($val->created_at)),
                    $val->type(),
                    $val->status(),
                    '
                        <a href="' . url('admin/manage/order/so/' . $val->id) . '" class="btn bg-brown btn-sm">SO</a>
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

    public function so(Request $request, $id) 
    {
        $query = Order::find($id);
        if($query->type == 2) {
            return redirect()->back();
        }

        $data  = [
            'title'   => 'Manage Order SO',
            'order'   => $query,
            'content' => 'admin.manage.order_so'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
