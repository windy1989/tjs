<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Manage Voucher',
            'content' => 'admin.manage.voucher'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'name',
            'code',
            'quota',
            'used',
            'type',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Voucher::count();
        
        $query_data = Voucher::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    });
                }      
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Voucher::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    });
                }       
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                if($val->start_date < date('Y-m-d')) {
                    $status = 'Not Active';
                    $button = '
                        <a href="' . url('admin/manage/voucher/detail/' . $val->id) . '" class="btn bg-info btn-sm" data-popup="tooltip" title="Detail"><i class="icon-info22"></i></a>
                        <a href="' . url('admin/manage/voucher/update/' . $val->id) . '" class="btn bg-warning btn-sm" data-popup="tooltip" title="Edit"><i class="icon-pencil7"></i></a>
                        <button type="button" class="btn bg-danger btn-sm" data-popup="tooltip" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>
                    ';
                } else if($val->start_date >= date('Y-m-d') && $val->finish_date <= date('Y-m-d')) {
                    $status = 'Running';
                    $button = '
                        <button type="button" class="btn bg-danger btn-sm" data-popup="tooltip" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>
                    ';
                } else {
                    $status = 'Expired';
                    $button = '
                        <button type="button" class="btn bg-danger btn-sm" data-popup="tooltip" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>
                    ';
                }

                $response['data'][] = [
                    $nomor,
                    $val->name,
                    $val->code,
                    $val->quota,
                    $val->order->count(),
                    $val->type(),
                    $status,
                    $button
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

    public function create(Request $request)
    {
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'code'        => 'required|min:7|unique:vouchers,code',
                'name'        => 'required',
                'minimum'     => 'required',
                'maximum'     => 'required',
                'quota'       => 'required',
                'start_date'  => 'required',
                'finish_date' => 'required',
                'terms'       => 'required',
                'type'        => 'required'
            ], [
                'code.required'        => 'Code cannot be empty.',
                'code.min'             => 'Code minimum 7 character.',
                'code.unique'          => 'Code exists.',
                'minimum.required'     => 'Minimum order cannot be empty.',
                'maximum.required'     => 'Nominal cannot be empty.',
                'quota.required'       => 'Quota cannot be empty.',
                'start_date.required'  => 'Start date cannot be empty.',
                'finish_date.required' => 'Finish date cannot be empty.',
                'terms.required'       => 'Terms & conditions cannot be empty.',
                'type.required'        => 'Please select a type.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query = Voucher::create([
                    'code'        => $request->code,
                    'name'        => $request->name,
                    'minimum'     => $request->minimum,
                    'maximum'     => $request->maximum,
                    'quota'       => $request->quota,
                    'start_date'  => $request->start_date,
                    'finish_date' => $request->finish_date,
                    'terms'       => $request->terms,
                    'type'        => $request->type
                ]);

                if($query) {
                    activity()
                        ->performedOn(new Voucher())
                        ->causedBy(session('bo_id'))
                        ->withProperties($query)
                        ->log('Add manage voucher data');

                    return redirect()->back()->with(['success' => 'Data added successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to added.']);
                }
            }
        } else {
            $data = [
                'title'    => 'Create New Voucher',
                'category' => Category::where('type', 2)->get(),
                'content'  => 'admin.manage.voucher_create'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function update(Request $request, $id)
    {
        $query = Voucher::find($id);
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'code'        => ['required', 'min:7', Rule::unique('vouchers', 'code')->ignore($id)],
                'name'        => 'required',
                'minimum'     => 'required',
                'maximum'     => 'required',
                'quota'       => 'required',
                'start_date'  => 'required',
                'finish_date' => 'required',
                'terms'       => 'required',
                'type'        => 'required'
            ], [
                'code.required'        => 'Code cannot be empty.',
                'code.min'             => 'Code minimum 7 character.',
                'code.unique'          => 'Code exists.',
                'minimum.required'     => 'Minimum order cannot be empty.',
                'maximum.required'     => 'Nominal cannot be empty.',
                'quota.required'       => 'Quota cannot be empty.',
                'start_date.required'  => 'Start date cannot be empty.',
                'finish_date.required' => 'Finish date cannot be empty.',
                'terms.required'       => 'Terms & conditions cannot be empty.',
                'type.required'        => 'Please select a type.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query->update([
                    'code'        => $request->code,
                    'name'        => $request->name,
                    'minimum'     => $request->minimum,
                    'maximum'     => $request->maximum,
                    'quota'       => $request->quota,
                    'start_date'  => $request->start_date,
                    'finish_date' => $request->finish_date,
                    'terms'       => $request->terms,
                    'type'        => $request->type
                ]);

                if($query) {
                    activity()
                        ->performedOn(new Voucher())
                        ->causedBy(session('bo_id'))
                        ->log('Change the manage voucher data');

                    return redirect()->back()->with(['success' => 'Data updated successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to update..']);
                }
            }
        } else {
            $data = [
                'title'    => 'Update Voucher',
                'voucher'  => $query,
                'content'  => 'admin.manage.voucher_update'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function destroy(Request $request) 
    {
        $query = Voucher::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new Voucher())
                ->causedBy(session('bo_id'))
                ->log('Delete the manage voucher data');

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

    public function detail($id)
    {
        $data = [
            'title'   => 'Detail Voucher',
            'news'    => Voucher::find($id),
            'content' => 'admin.manage.voucher_detail'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
