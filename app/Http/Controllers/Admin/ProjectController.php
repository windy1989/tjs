<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectSample;
use App\Models\ProjectProduct;
use App\Http\Controllers\Controller;
use App\Models\ProjectConsultantMeeting;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller {
    
    public function index() 
    {
        $data = [
            'title'   => 'Project',
            'country' => Country::where('status', 1)->get(),
            'city'    => City::all(),
            'content' => 'admin.project'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'user_id',
            'name',
            'progress'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Project::count();
        
        $query_data = Project::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhereHas('user', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('email', 'like', "%$search%");
                                });
                    });
                }  
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Project::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhereHas('user', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%")
                                        ->orWhere('email', 'like', "%$search%");
                                });
                    });
                }      
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                if($val->progress == 100) {
                    $action = '<a href="' . url('admin/project/detail/' . $val->id) . '" class="btn bg-warning btn-sm" data-popup="tooltip" title="Detail"><i class="icon-info22"></i></a>';

                    $progress = '
                        <div class="progress" style="height:25px;">
                            <div class="progress-bar progress-bar-striped bg-teal" style="width:100%">
                                <span class="font-weight-bold text-uppercase">
                                    <span style="font-size:14px;">' . $val->progress . '%</span> Done
                                </span>
                            </div>
                        </div>
                    ';
                } else {
                    $action = '<a href="' . url('admin/project/manage/' . $val->id) . '" class="btn bg-warning btn-sm" data-popup="tooltip" title="Manage"><i class="icon-hammer-wrench"></i></a>';

                    $progress = '
                        <div class="progress" style="height:25px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-indigo" style="width:100%;">
                                <span class="font-weight-bold text-uppercase">
                                    <span style="font-size:14px;">' . $val->progress . '%</span> On Process
                                </span>
                            </div>
                        </div>
                    ';
                }

                $response['data'][] = [
                    $nomor,
                    $val->user->name,
                    $val->name,
                    $progress,
                    $action
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
        $validation = Validator::make($request->all(), [
            'country_id'     => 'required',
            'city_id'        => 'required',
            'name'           => 'required',
            'email'          => 'required|email',
            'phone'          => 'required|min:9|numeric',
            'timeline'       => 'required',
            'constructor'    => 'required',
            'manager'        => 'required',
            'consultant'     => 'required',
            'owner'          => 'required',
            'payment_method' => 'required',
            'supply_method'  => 'required',
            'ppn'            => 'required'
        ], [
            'country_id.required'     => 'Please select a country.',
            'city_id.required'        => 'Please select a city.',
            'name.required'           => 'Name cannot be empty.',
            'email.required'          => 'Email cannot be empty.',
            'email.email'             => 'Email not valid.',
            'phone.required'          => 'Phone cannot be empty',
            'phone.min'               => 'Phone must be at least 9 characters long',
            'phone.numeric'           => 'Phone must be number',
            'timeline.required'       => 'Timeline cannot be empty',
            'constructor.required'    => 'Constructor name cannot be empty',
            'manager.required'        => 'Project manager cannot be empty',
            'consultant.required'     => 'Consultant name cannot be empty',
            'owner.required'          => 'Owner cannot be empty',
            'payment_method.required' => 'Please select a payment method.',
            'supply_method.required'  => 'Please select a supply method.',
            'ppn.required'            => 'Please select a PPN.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Project::create([
                'user_id'        => session('bo_id'),
                'country_id'     => $request->country_id,
                'city_id'        => $request->city_id,
                'name'           => $request->name,
                'email'          => $request->email,
                'phone'          => $request->phone,
                'timeline'       => $request->timeline,
                'constructor'    => $request->constructor,
                'manager'        => $request->manager,
                'consultant'     => $request->consultant,
                'owner'          => $request->owner,
                'payment_method' => $request->payment_method,
                'supply_method'  => $request->supply_method,
                'ppn'            => $request->ppn,
                'progress'       => 10
            ]);

            if($query) {
                activity()
                    ->performedOn(new Project())
                    ->causedBy(session('bo_id'))
                    ->withProperties($query)
                    ->log('Add project data');

                $response = [
                    'status'  => 200,
                    'message' => 'Data added successfully.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data failed to add.'
                ];
            }
        }

        return response()->json($response);
    }

    public function getProduct(Request $request)
    {
        $data  = Product::find($request->id);
        $price = $data->pricingPolicy;

        return response()->json([
            'id'     => $data->id,
            'code'   => $data->code(),
            'price'  => $price ? $price->project_price : 0,
            'bottom' => $price ? $price->bottom_price : 0
        ]);
    }

    public function manage(Request $request, $id)
    {
        $query = Project::find($id);
        $step  = $request->submit;

        if($request->has('_token') && session()->token() == $request->_token) {
            switch($step) {
                case 'step-1':
                    $validation = Validator::make($request->all(), [
                        'country_id'     => 'required',
                        'city_id'        => 'required',
                        'name'           => 'required',
                        'email'          => 'required|email',
                        'phone'          => 'required|min:9|numeric',
                        'timeline'       => 'required',
                        'constructor'    => 'required',
                        'manager'        => 'required',
                        'consultant'     => 'required',
                        'owner'          => 'required',
                        'payment_method' => 'required',
                        'supply_method'  => 'required',
                        'ppn'            => 'required'
                    ], [
                        'country_id.required'     => 'Please select a country.',
                        'city_id.required'        => 'Please select a city.',
                        'name.required'           => 'Name cannot be empty.',
                        'email.required'          => 'Email cannot be empty.',
                        'email.email'             => 'Email not valid.',
                        'phone.required'          => 'Phone cannot be empty',
                        'phone.min'               => 'Phone must be at least 9 characters long',
                        'phone.numeric'           => 'Phone must be number',
                        'timeline.required'       => 'Timeline cannot be empty',
                        'constructor.required'    => 'Constructor name cannot be empty',
                        'manager.required'        => 'Project manager cannot be empty',
                        'consultant.required'     => 'Consultant name cannot be empty',
                        'owner.required'          => 'Owner cannot be empty',
                        'payment_method.required' => 'Please select a payment method.',
                        'supply_method.required'  => 'Please select a supply method.',
                        'ppn.required'            => 'Please select a PPN.'
                    ]);
                    break;

                case 'step-2':
                    $validation = Validator::make($request->all(), [
                        'product_id' => 'required|array'
                    ], [
                        'product_id.required' => 'Please add min 1 product.',
                        'product_id.array'    => 'product_id must be array.'
                    ]);
                    break;

                case 'step-3':
                    $validation = Validator::make($request->all(), [
                        'consultant_date'   => 'required|array',
                        'consultant_person' => 'required|array',
                        'consultant_result' => 'required|array'
                    ], [
                        'consultant_date.required'   => 'Date cannot empty.',
                        'consultant_date.array'      => 'Date must be array.',
                        'consultant_person.required' => 'Person cannot empty.',
                        'consultant_person.array'    => 'Person must be array.',
                        'consultant_result.required' => 'Result cannot empty.',
                        'consultant_result.array'    => 'Result must be array.'
                    ]);
                    break;

                case 'step-4':
                    $validation = Validator::make($request->all(), [
                        'product_recommended_price' => 'required|array'
                    ], [
                        'product_recommended_price.required' => 'Recommended price cannot empty.',
                        'product_recommended_price.array'    => 'Recommended price must be array.'
                    ]);
                    break;

                case 'step-5':
                    $validation = Validator::make($request->all(), [
                        'sample_product_id' => 'required|array',
                        'sample_date'       => 'required|array',
                        'sample_qty'        => 'required|array',
                        'sample_size'       => 'required|array'
                    ], [
                        'sample_product_id.required' => 'Please select a product.',
                        'sample_product_id.array'    => 'Product id must be array.',
                        'sample_date.required'       => 'Date cannot empty.',
                        'sample_date.array'          => 'Date must be array.',
                        'sample_qty.required'        => 'Qty cannot empty.',
                        'sample_qty.array'           => 'Qty must be array.',
                        'sample_size.required'       => 'Size cannot empty.',
                        'sample_size.array'          => 'Size must be array.'
                    ]);
                    break;

                case 'step-6':
                    $validation = Validator::make($request->all(), [
                        'product_discount' => 'required|array'
                    ], [
                        'product_discount.required' => 'Discount cannot empty.',
                        'product_discount.array'    => 'Discount must be array.'
                    ]);
                    break;
            }

            if($validation->fails()) {
                return redirect('admin/project/manage/' . $id . '?' . $step . '=1#' . $step)
                    ->withErrors($validation)
                    ->withInput();
            } else {
                switch($step) {
                    case 'step-1':
                        $query->update([
                            'country_id'     => $request->country_id,
                            'city_id'        => $request->city_id,
                            'name'           => $request->name,
                            'email'          => $request->email,
                            'phone'          => $request->phone,
                            'timeline'       => $request->timeline,
                            'constructor'    => $request->constructor,
                            'manager'        => $request->manager,
                            'consultant'     => $request->consultant,
                            'owner'          => $request->owner,
                            'payment_method' => $request->payment_method,
                            'supply_method'  => $request->supply_method,
                            'ppn'            => $request->ppn
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 1)');
                        break;

                    case 'step-2':
                        $query->update([
                            'progress' => $query->progress < 15 ? 15 : $query->progress
                        ]);

                        foreach($request->product_id as $key => $pi) {
                            ProjectProduct::create([
                                'project_id'   => $query->id,
                                'product_id'   => $pi,
                                'qty'          => $request->product_qty[$key],
                                'price'        => $request->product_price[$key],
                                'target_price' => $request->product_target_price[$key],
                                'unit'         => $request->product_unit[$key]
                            ]);
                        }

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 2)');
                        break;

                    case 'step-3':
                        $query->update([
                            'progress' => $query->progress < 20 ? 20 : $query->progress
                        ]);

                        foreach($request->consultant_date as $key => $cd) {
                            ProjectConsultantMeeting::create([
                                'project_id' => $query->id,
                                'date'       => $cd,
                                'person'     => $request->consultant_person[$key],
                                'result'     => $request->consultant_result[$key]
                            ]);
                        }

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 3)');
                        break;

                    case 'step-4':
                        $query->update([
                            'progress' => $query->progress < 25 ? 25 : $query->progress
                        ]);

                        foreach($request->project_product_id as $key => $ppi) {
                            ProjectProduct::find($ppi)->update([
                                'recommended_price' => $request->product_recommended_price[$key]
                            ]);
                        }

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 4)');
                        break;

                    case 'step-5':
                        $query->update([
                            'progress' => $query->progress < 30 ? 30 : $query->progress
                        ]);

                        foreach($request->sample_product_id as $key => $spi) {
                            ProjectSample::create([
                                'project_id' => $query->id,
                                'product_id' => $spi,
                                'date'       => $request->sample_date[$key],
                                'qty'        => $request->sample_qty[$key],
                                'size'       => $request->sample_size[$key]
                            ]);
                        }

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 5)');
                        break;

                    case 'step-6':
                        $query->update([
                            'progress' => $query->progress < 35 ? 35 : $query->progress
                        ]);

                        foreach($request->project_product_id as $key => $ppi) {
                            ProjectProduct::find($ppi)->update([
                                'discount' => $request->product_discount[$key]
                            ]);
                        }

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 6)');
                        break;
                }

                return redirect('admin/project/manage/' . $id . '?' . $step . '=1#' . $step)
                    ->with(['success' => 'Data successfully saved.']);
            }
        } else {
            $data = [
                'title'   => 'Manage Project',
                'country' => Country::where('status', 1)->get(),
                'city'    => City::all(),
                'project' => $query,
                'content' => 'admin.project_manage'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

}
