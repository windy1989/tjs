<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Project;
use App\Models\Approval;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApprovalController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Approval',
            'content' => 'admin.approval'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'approvalable_type',
            'ref',
            'created_at',
            'approved_by',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Approval::where('user_id', session('bo_id'))
            ->count();
        
        $query_data = Approval::where('user_id', session('bo_id'))
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('approvedBy', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhere('approvalable_type', 'like', "%$search%");
                }   
                
                if($request->type) {
                    $query->where('approvalable_type', $request->type);
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

        $total_filtered = Approval::where('user_id', session('bo_id'))
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->whereHas('approvedBy', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhere('approvalable_type', 'like', "%$search%");
                }   
                
                if($request->type) {
                    $query->where('approvalable_type', $request->type);
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
                    $val->type(),
                    $val->approvalable_type == 'orders' ? $val->approvalable->sales_order : $val->approvalable->code,
                    date('d F Y', strtotime($val->created_at)),
                    $val->approved_by ? $val->approvedBy->name : '-',
                    $val->status(),
                    '
                        <a href="' . url('admin/approval/detail/' . $val->id) . '" class="btn bg-info btn-sm"><i class="icon-info22"></i> Process</a>
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
        $approval = Approval::find($id);
        $order    = Order::find($approval->approvalable_id);
        $project  = Project::find($approval->approvalable_id);
        $status   = $request->reject ? 3 : 2;
        $approval->update(['seen' => true]);
        
        if($approval->approvalable_type == 'orders') {
            $title       = 'Approval Sales Order';
            $view        = 'approval_sales_order_detail';
            $notif_title = 'Approval Sales Order';
            $description = $approval->approvalable->sales_order;
            $link        = url('admin/manage/sales_order/detail/' . $approval->approvalable_id);
        } else if($approval->approvalable_type == 'projects') {
            $title       = 'Approval Project';
            $view        = 'approval_project_detail';
            $notif_title = 'Approval Project';
            $description = $approval->approvalable->code;
            $link        = url('admin/manage/project/progress/' . $approval->approvalable_id);
        }

        if($request->has('_token') && session()->token() == $request->_token) {
            if($request->reject) {
                if($approval->approvalable_type == 'orders') {
                    foreach($order->orderDetail as $od) {
                        OrderDetail::find($od->id)->update([
                            'target_price' => $od->total
                        ]);
                    }

                    $order->update([
                        'subtotal'   => $order->orderDetail->sum('total'),
                        'grandtotal' => $order->orderDetail->sum('total') + $order->shipping
                    ]);
                } else {

                }

                $notif_desc = 'Sorry, your data ' . $description . ' has been rejected';
            } else {
                if($approval->approvalable_type == 'orders') {
                    $total_discount = 0;
                    foreach($order->orderDetail as $od) {
                        $total_discount += $od->total - $od->target_price;
                        OrderDetail::find($od->id)->update([
                            'total' => $od->target_price
                        ]);
                    }

                    $order->update([
                        'subtotal'   => $order->orderDetail->sum('total'),
                        'discount'   => $total_discount,
                        'grandtotal' => $order->orderDetail->sum('total') + $order->shipping
                    ]);
                } else {

                }

                $notif_desc = 'Success, your data ' . $description . ' has been approved';
            }

            $approval->update([
                'approved_by' => session('bo_id'),
                'status'      => $status
            ]);
            
            Notification::create([
                'user_id'     => $approval->reference,
                'title'       => $notif_title,
                'description' => $notif_desc,
                'link'        => $link
            ]);

            return redirect()->back()->with(['success' => 'Data has been processed']);
        }

        $data  = [
            'title'    => $title,
            'approval' => $approval,
            'order'    => $order,
            'project'  => $project,
            'content'  => 'admin.' . $view
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
