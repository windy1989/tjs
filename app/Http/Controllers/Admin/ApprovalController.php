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
                $check = Approval::where('approvalable_type', $val->approvalable_type)
                    ->where('approvalable_id', $val->approvalable_id)
                    ->whereNotNull('approved_by')
                    ->first();

                if($check) {
                    $approved_by = $check->approvedBy->name;
                    $btn         = '<a href="' . url('admin/approval/detail/' . $val->id) . '" class="btn bg-success btn-sm"><i class="icon-check"></i> View</a>';
                } else {
                    $approved_by = '-';
                    $btn         = '<a href="' . url('admin/approval/detail/' . $val->id) . '" class="btn bg-info btn-sm"><i class="icon-info22"></i> Process</a>';
                }

                $response['data'][] = [
                    $nomor,
                    $val->type(),
                    $val->approvalable_type == 'projects' ? $val->approvalable->code : '',
                    date('d F Y', strtotime($val->created_at)),
                    $approved_by,
                    $val->status(),
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
        $approval = Approval::find($id);
        $project  = Project::find($approval->approvalable_id);
        $status   = $request->reject ? 3 : 2;
        $approved = Approval::where('approvalable_type', $approval->approvalable_type)
            ->where('approvalable_id', $approval->approvalable_id)
            ->whereNotNull('approved_by')
            ->first();

        $approval->update(['seen' => true]);
        if($approval->approvalable_type == 'projects') {
            $title       = 'Approval Project';
            $view        = 'approval_project_detail';
            $notif_title = 'Approval Project';
            $description = $approval->approvalable->code;
            $link        = url('admin/manage/project/progress/' . $approval->approvalable_id);
        }

        if($request->has('_token') && session()->token() == $request->_token) {
            if($request->reject) {
                if($approval->approvalable_type == 'projects') {
                    
                }

                $notif_desc = 'Sorry, your data ' . $description . ' has been rejected';
            } else {
                if($approval->approvalable_type == 'projects') {
                    
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
            'approved' => $approved,
            'project'  => $project,
            'content'  => 'admin.' . $view
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
