<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VoucherCategoryController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Voucher Category',
            'content' => 'admin.voucher.category'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'voucherable_id',
            'name',
            'code',
            'percentage',
            'type',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Voucher::where('voucherable_type', 'categories')
            ->count();
        
        $query_data = Voucher::where('voucherable_type', 'categories')
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('voucherable', function($query) use ($request) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    });
                }      
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Voucher::where('voucherable_type', 'categories')
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('voucherable', function($query) use ($request) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    });
                }       
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $current_date = strtotime(date('Y-m-d'));
                if($current_date < strtotime($val->start_date)) {
                    $status = 'Not Active';
                    $button = '
                        <a href="' . url('admin/voucher/category/detail/' . $val->id) . '" class="btn bg-info btn-sm" data-popup="tooltip" title="Detail"><i class="icon-info22"></i></a>
                        <a href="' . url('admin/voucher/category/update/' . $val->id) . '" class="btn bg-warning btn-sm" data-popup="tooltip" title="Edit"><i class="icon-pencil7"></i></a>
                        <button type="button" class="btn bg-danger btn-sm" data-popup="tooltip" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>
                    ';
                } else if($current_date >= strtotime($val->start_date) && $current_date <= strtotime($val->finish_date)) {
                    $status = 'Running';
                    $button = '
                        <a href="' . url('admin/voucher/category/update/' . $val->id) . '" class="btn bg-warning btn-sm" data-popup="tooltip" title="Edit"><i class="icon-pencil7"></i></a>
                        <a href="' . url('admin/voucher/category/detail/' . $val->id) . '" class="btn bg-info btn-sm" data-popup="tooltip" title="Detail"><i class="icon-info22"></i></a>
                    ';
                } else {
                    $status = 'Expired';
                    $button = '
                        <a href="' . url('admin/voucher/category/detail/' . $val->id) . '" class="btn bg-info btn-sm" data-popup="tooltip" title="Detail"><i class="icon-info22"></i></a>
                    ';
                }

                $response['data'][] = [
                    $nomor,
                    $val->voucherable->name,
                    $val->name,
                    $val->code,
                    $val->percentage . '%',
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
                'voucherable_id' => 'required',
                'code'           => 'required|min:3|unique:vouchers,code',
                'name'           => 'required',
                'minimum'        => 'required',
                'maximum'        => 'required',
                'quota'          => 'required',
                'points'         => 'required',
                'percentage'     => 'required',
                'start_date'     => 'required',
                'finish_date'    => 'required',
                'terms'          => 'required',
                'type'           => 'required'
            ], [
                'voucherable_id.required' => 'Please select a category.',
                'code.required'           => 'Code cannot be empty.',
                'code.min'                => 'Code minimum 3 character.',
                'code.unique'             => 'Code exists.',
                'name.required'           => 'Name cannot be empty.',
                'minimum.required'        => 'Minimum order cannot be empty.',
                'maximum.required'        => 'Maximum discount cannot be empty.',
                'quota.required'          => 'Quota cannot be empty.',
                'points.required'         => 'Points cannot be empty.',
                'percentage.required'     => 'Percentage cannot be empty.',
                'start_date.required'     => 'Start date cannot be empty.',
                'finish_date.required'    => 'Finish date cannot be empty.',
                'terms.required'          => 'Terms & conditions cannot be empty.',
                'type.required'           => 'Please select a type.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query = Voucher::create([
                    'voucherable_type' => 'categories',
                    'voucherable_id'   => $request->voucherable_id,
                    'code'             => strtoupper($request->code),
                    'name'             => $request->name,
                    'minimum'          => $request->minimum,
                    'maximum'          => $request->maximum,
                    'quota'            => $request->quota,
                    'points'           => $request->points,
                    'percentage'       => $request->percentage,
                    'start_date'       => $request->start_date,
                    'finish_date'      => $request->finish_date,
                    'terms'            => $request->terms,
                    'type'             => $request->type
                ]);

                if($query) {
                    activity()
                        ->performedOn(new Voucher())
                        ->causedBy(session('bo_id'))
                        ->withProperties($query)
                        ->log('Add voucher category data');

                    return redirect()->back()->with(['success' => 'Data added successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to added.']);
                }
            }
        } else {
            $data = [
                'title'    => 'Create New Voucher',
                'category' => Category::has('type')->get(),
                'content'  => 'admin.voucher.category_create'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function update(Request $request, $id)
    {
        $query = Voucher::find($id);
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'code'        => ['required', 'min:3', Rule::unique('vouchers', 'code')->ignore($id)],
                'name'        => 'required',
                'quota'       => 'required',
                'finish_date' => 'required',
                'terms'       => 'required'
            ], [
                'code.required'        => 'Code cannot be empty.',
                'code.min'             => 'Code minimum 3 character.',
                'code.unique'          => 'Code exists.',
                'name.required'        => 'Name cannot be empty.',
                'quota.required'       => 'Quota cannot be empty.',
                'finish_date.required' => 'Finish date cannot be empty.',
                'terms.required'       => 'Terms & conditions cannot be empty.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query->update([
                    'code'        => strtoupper($request->code),
                    'name'        => $request->name,
                    'quota'       => $request->quota,
                    'finish_date' => $request->finish_date,
                    'terms'       => $request->terms
                ]);

                if($query) {
                    activity()
                        ->performedOn(new Voucher())
                        ->causedBy(session('bo_id'))
                        ->log('Change the voucher category data');

                    return redirect()->back()->with(['success' => 'Data updated successfully.']);
                } else {
                    return redirect()->back()->withInput()->with(['failed' => 'Data failed to update..']);
                }
            }
        } else {
            $data = [
                'title'    => 'Update Voucher',
                'category' => Category::has('type')->get(),
                'voucher'  => $query,
                'content'  => 'admin.voucher.category_update'
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
                ->log('Delete the voucher category data');

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
            'voucher' => Voucher::find($id),
            'content' => 'admin.voucher.category_detail'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
