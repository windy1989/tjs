<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\City;
use App\Models\Coa;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Project;
use App\Models\Delivery;
use App\Models\ProjectPay;
use Illuminate\Http\Request;
use App\Models\ProjectSample;
use App\Models\ProjectPayment;
use App\Models\ProjectProduct;
use App\Models\ProjectDelivery;
use App\Models\ProjectShipment;
use App\Models\ProjectProduction;
use App\Models\ProjectWarehouse;
use App\Models\ProjectQuotation;
use App\Models\ProjectQuotationProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectConsultantMeeting;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller {
    
    public function index() 
    {
        $data = [
            'title'   => 'Sales Project',
            'country' => Country::where('status', 1)->get(),
            'city'    => City::all(),
			'bank' => Coa::where('parent_id', 8)->where('status', 1)->get(),
            'customer' => Customer::where('type', 2)->get(),
            'content' => 'admin.sales.project'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'code',
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
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%");
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
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%");
                    });
                }      
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                if($val->progress == 100) {
                    $action = '<a href="' . url('admin/sales/project/progress/' . $val->id) . '" class="btn bg-success btn-sm" data-popup="tooltip" title="Detail"><i class="icon-info22"></i></a>';

                    $progress = '
                        <div class="progress" style="height:0.875rem;">
                            <div class="progress-bar progress-bar-striped bg-teal" style="width:100%">
                                <span class="font-weight-bold text-uppercase">
                                    <span style="font-size:13px;">' . $val->progress . '%</span>
                                </span>
                            </div>
                        </div>
                    ';
                } else {
                    $action = '<a href="' . url('admin/sales/project/progress/' . $val->id) . '" class="btn bg-warning btn-sm" data-popup="tooltip" title="Progress"><i class="icon-hammer-wrench"></i></a>';

                    $progress = '
                        <div class="progress" style="height:0.875rem;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width:100%;">
                                <span class="font-weight-bold text-uppercase">
                                    <span style="font-size:13px;">' . $val->progress . '%</span>
                                </span>
                            </div>
                        </div>
                    ';
                }

                $response['data'][] = [
                    $nomor,
                    $val->code,
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
            'customer_id'    => 'required',
            'timeline'       => 'required',
            'manager'        => 'required',
            'consultant'     => 'required',
            'owner'          => 'required',
			'bank_id'    	 => 'required',
            'payment_method' => 'required',
            'supply_method'  => 'required',
            'ppn'            => 'required'
        ], [
            'country_id.required'     => 'Please select a country.',
            'city_id.required'        => 'Please select a city.',
            'name.required'           => 'Name cannot be empty.',
            'customer_id.required'    => 'Customer cannot be empty.',
            'timeline.required'       => 'Timeline cannot be empty',
            'constructor.required'    => 'Constructor name cannot be empty',
            'manager.required'        => 'Project manager cannot be empty',
            'consultant.required'     => 'Consultant name cannot be empty',
            'owner.required'          => 'Owner cannot be empty',
			'bank_id.required' 		  => 'Please select a bank destination.',
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
                'code'           => Project::generateCode(),
                'name'           => $request->name,
                'customer_id'    => $request->customer_id,
                'timeline'       => $request->timeline,
                'manager'        => $request->manager,
                'consultant'     => $request->consultant,
                'owner'          => $request->owner,
				'coa_id' 		 => $request->bank_id,
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
        $image = '<a href="' . $data->type->image() . '" data-lightbox="' . $data->name() . '" data-title="' . $data->name() . '"><img src="' . $data->type->image() . '" style="max-width:70px;" class="img-fluid img-thumbnail mb-2"></a>';

        return response()->json([
            'id'      => $data->id,
            'product' => $image . '<div>' . $data->name() . '</div><div>' . $data->type->length . 'x' . $data->type->width . '</div>',
            'price'   => $price ? $price->project_price : 0,
            'bottom'  => $price ? $price->bottom_price : 0,
			'carton_pcs' => $data->carton_pcs,
			'carton_sqm' => (($data->type->length * $data->type->width) / 10000) * $data->carton_pcs.' M<sup>2</sup>'
        ]);
    }
    
    public function getDelivery(Request $request)
    {
        $total_weight = 0;
        $project      = Project::find($request->id);

        foreach($project->projectProduct as $pp) {
            $total_weight += $pp->product->type->weight * $pp->qty;
        }

        $data     = [];
        $city_id  = $request->city_id;
        $delivery = Delivery::where('destination_id', $city_id)
            ->where('capacity', '>=', $total_weight)
            ->orderBy('capacity', 'asc')
            ->groupBy('transport_id')
            ->get();

        foreach($delivery as $d) {
            $data[] = [
                'id'             => $d->id,
                'price'          => 'Rp ' . number_format($d->price_per_kg * $total_weight, '0', ',', '.'),
                'transport_name' => $d->transport->fleet
            ];
        }

        return response()->json($data);
    }

    public function progress(Request $request, $id)
    {
        $query = Project::find($id);
        $step  = $request->submit;
        
        if(!$query) {
            abort(404);
        }

        if($request->has('_token') && session()->token() == $request->_token) {
            switch($step) {
                case 'step-1':
                    $validation = Validator::make($request->all(), [
                        'country_id'     => 'required',
                        'city_id'        => 'required',
                        'name'           => 'required',
                        'customer_id'    => 'required',
                        'timeline'       => 'required',
                        'manager'        => 'required',
                        'consultant'     => 'required',
                        'owner'          => 'required',
						'bank_id'    	 => 'required',
                        'payment_method' => 'required',
                        'supply_method'  => 'required',
                        'ppn'            => 'required'
                    ], [
                        'country_id.required'     => 'Please select a country.',
                        'city_id.required'        => 'Please select a city.',
                        'name.required'           => 'Name cannot be empty.',
                        'customer_id.required'    => 'Customer cannot be empty.',
                        'timeline.required'       => 'Timeline cannot be empty',
                        'manager.required'        => 'Project manager cannot be empty',
                        'consultant.required'     => 'Consultant name cannot be empty',
                        'owner.required'          => 'Owner cannot be empty',
						'bank_id.required' 		  => 'Please select a bank destination.',
                        'payment_method.required' => 'Please select a payment method.',
                        'supply_method.required'  => 'Please select a supply method.',
                        'ppn.required'            => 'Please select a PPN.'
                    ]);
                    break;

                case 'step-2':
                    $validation = Validator::make($request->all(), [
						'delivery_cost' => 'required',
						'cutting_cost' => 'required',
						'misc_cost' => 'required',
                        'product_id' => 'required|array'
                    ], [
						'delivery_cost'       => 'Delivery cost cannot be empty',
						'cutting_cost'        => 'Cutting cost manager cannot be empty',
						'misc_cost'        	  => 'Miscellaneous cost cannot be empty',
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
                        'product_recommended_price' => 'required|array',
						'product_best_price' => 'required|array',
                        'product_discount' => 'required|array'
                    ], [
                        'product_recommended_price.required' => 'Recommended price cannot empty.',
                        'product_recommended_price.array'    => 'Recommended price must be array.',
						'product_best_price.required' => 'Best Price cannot empty.',
                        'product_best_price.array'    => 'Best Price must be array.',
                        'product_discount.required' => 'Discount cannot empty.',
                        'product_discount.array'    => 'Discount must be array.'
                    ]);
                    break;

                case 'step-5':
                    $validation = Validator::make($request->all(), [
                        'sample_product_id' => 'required|array',
                        'sample_date'       => 'required|array',
                        'sample_qty'        => 'required|array',
						'sample_unit'       => 'required|array',
                        'sample_size'       => 'required|array'
                    ], [
                        'sample_product_id.required' => 'Please select a product.',
                        'sample_product_id.array'    => 'Product id must be array.',
                        'sample_date.required'       => 'Date cannot empty.',
                        'sample_date.array'          => 'Date must be array.',
                        'sample_qty.required'        => 'Qty cannot empty.',
                        'sample_qty.array'           => 'Qty must be array.',
						'sample_unit.required'       => 'Unit cannot empty.',
                        'sample_unit.array'          => 'Unit must be array.',
                        'sample_size.required'       => 'Size cannot empty.',
                        'sample_size.array'          => 'Size must be array.'
                    ]);
                    break;

                case 'step-6':
                    $validation = Validator::make($request->all(), [
						
                    ], [
						
                    ]);
                    break;

                case 'step-7':
                    $validation = Validator::make($request->all(), [
						'file'   => 'required|mimes:jpg,jpeg,png,pdf',
                        'submit' => 'required'
                    ], [
						'file.required'   => 'File cannot empty.',
                        'file.mimes'      => 'File must have an extension jpg, jpeg, png, pdf.',
                        'submit.required' => 'Step cannot empty.'
                    ]);
                    break;

                case 'step-8':
                    $validation = Validator::make($request->all(), [
                        'submit' => 'required'
                    ], [
                        'submit.required' => 'Step cannot empty.'
                    ]);
                    break;

                case 'step-9':
                    $validation = Validator::make($request->all(), [
                        'image'   => 'required|mimes:jpg,jpeg,png',
                        'date'    => 'required',
                        'bank'    => 'required',
                        'nominal' => 'required'
                    ], [
                        'image.required'   => 'Image cannot empty.',
                        'image.image'      => 'File must be an image.',
                        'image.mimes'      => 'Image must have an extension jpg, jpeg, png.',
                        'date.required'    => 'Date cannot empty.',
                        'bank.required'    => 'Bank cannot empty.',
                        'nominal.required' => 'Nominal cannot empty.'
                    ]);
                    break;

                case 'step-10':
                    $validation = Validator::make($request->all(), [
                        'image'       => 'required|mimes:jpg,jpeg,png',
                        'start_date'  => 'required',
                        'finish_date' => 'required',
                        'note'        => 'required',
						'progress_production'  => 'required'
                    ], [
                        'image.required'       => 'Image cannot empty.',
                        'image.image'          => 'File must be an image.',
                        'image.mimes'          => 'Image must have an extension jpg, jpeg, png.',
                        'start_date.required'  => 'Start date cannot empty.',
                        'finish_date.required' => 'Finish date cannot empty.',
                        'note.required'        => 'Note cannot empty.',
						'progress_production.required'   => 'Progress production cannot empty.'
                    ]);
                    break;

                case 'step-11':
                    $validation = Validator::make($request->all(), [
                        'image'   => 'required|mimes:jpg,jpeg,png',
                        'date'    => 'required',
                        'bank'    => 'required',
                        'nominal' => 'required'
                    ], [
                        'image.required'   => 'Image cannot empty.',
                        'image.image'      => 'File must be an image.',
                        'image.mimes'      => 'Image must have an extension jpg, jpeg, png.',
                        'date.required'    => 'Date cannot empty.',
                        'bank.required'    => 'Bank cannot empty.',
                        'nominal.required' => 'Nominal cannot empty.'
                    ]);
                    break;

                case 'step-12':
                    $validation = Validator::make($request->all(), [
                        'loading_date'   => 'required',
                        'departure_date' => 'required',
                        'from_port'      => 'required',
                        'to_port'        => 'required',
                        'eta'            => 'required'
                    ], [
                        'loading_date.required'   => 'Loading date cannot empty.',
                        'departure_date.required' => 'Departure date cannot empty.',
                        'from_port.required'      => 'from port cannot empty.',
                        'to_port.required'        => 'to port cannot empty.',
                        'eta.required'            => 'ETA cannot empty.'
                    ]);
                    break;
				case 'step-13':
					$validation = Validator::make($request->all(), [
                        'person'   			=> 'required',
                        'date_receive' 		=> 'required',
                        'warehouse_id'      => 'required',
                        'image'   			=> 'required|mimes:jpg,jpeg,png',
                    ], [
                        'person.required'   	=> 'Person who is responsible cannot empty.',
                        'date_receive.required' => 'Date received cannot empty.',
                        'warehouse_id.required' => 'Warehouse cannot empty.',
                        'image.required'   		=> 'Image cannot empty.',
                        'image.image'      		=> 'File must be an image.',
                        'image.mimes'      		=> 'Image must have an extension jpg, jpeg, png.',
                    ]);
					
					break;
				case 'step-14':
					
					break;
                case 'step-15':
                    $validation = Validator::make($request->all(), [
                        'receiver_name' => 'required',
                        'delivery_date' => 'required',
                        'email'         => 'required|email',
                        'phone'         => 'required|min:9|numeric',
                        'city_id'       => 'required',
                        'address'       => 'required',
                        'delivery_id'   => 'required'
                    ], [
                        'receiver_name.required' => 'Receiver name cannot be empty.',
                        'delivery_date.required' => 'Delivery date cannot be empty.',
                        'email.required'         => 'Email cannot be empty.',
                        'email.email'            => 'Email not valid.',
                        'phone.required'         => 'Phone cannot be empty',
                        'phone.min'              => 'Phone must be at least 9 characters long',
                        'phone.numeric'          => 'Phone must be number',
                        'city_id.required'       => 'Please select a city.',
                        'address.required'       => 'Address cannot be empty.',
                        'delivery_id.required'   => 'Please select a transport.'
                    ]);
                    break;
                
				case 'step-16':
					
					break;
				
                case 'step-17':
                    $validation = Validator::make($request->all(), [
                        'image'          => 'required|mimes:jpg,jpeg,png',
                        'date'           => 'required',
                        'payment'        => 'required',
                        'payment_method' => 'required',
                        'nominal'        => 'required'
                    ], [
                        'image.required'          => 'Image cannot empty.',
                        'image.image'             => 'File must be an image.',
                        'image.mimes'             => 'Image must have an extension jpg, jpeg, png.',
                        'payment.required'        => 'Please select a payment.',
                        'payment_method.required' => 'Please select a payment method.',
                        'nominal.required'        => 'Nominal cannot empty.'
                    ]);
                    break;

                case 'step-18':
                    $validation = Validator::make($request->all(), [
                        'submit' => 'required'
                    ], [
                        'submit.required' => 'Step cannot empty.'
                    ]);
                    break;
            }

            if($validation->fails()) {
                return redirect('admin/sales/project/progress/' . $id . '?' . $step . '=1#' . $step)
                    ->withErrors($validation)
                    ->withInput();
            } else {
                switch($step) {
                    case 'step-1':
                        $query->update([
                            'country_id'     => $request->country_id,
                            'city_id'        => $request->city_id,
                            'name'           => $request->name,
                            'customer_id'    => $request->customer_id,
                            'timeline'       => $request->timeline,
                            'constructor'    => $request->constructor,
                            'manager'        => $request->manager,
                            'consultant'     => $request->consultant,
                            'owner'          => $request->owner,
							'coa_id' 		 => $request->bank_id,
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
						
						Project::find($query->id)->update([
							'delivery_cost'	=> str_replace(',','.',str_replace('.','',$request->delivery_cost)),
							'cutting_cost'	=> str_replace(',','.',str_replace('.','',$request->cutting_cost)),
							'misc_cost'	=> str_replace(',','.',str_replace('.','',$request->misc_cost))
						]);
						
						ProjectProduct::where('project_id',$query->id)->whereNotIn('product_id',$request->product_id)->delete();
						
                        foreach($request->product_id as $key => $pi) {
                            $product = Product::find($pi);
                            $cogs    = 0;
                            
                            if($product->pricingPolicy) {
                                $cogs = $product->pricingPolicy->cogs;    
                            }
							
							$count = ProjectProduct::where('project_id',$query->id)->where('product_id',$pi)->count();
							
							if($count > 0){
								ProjectProduct::where(['project_id' => $query->id, 'product_id' => $pi])->update([
									'area'         => $request->product_area[$key],
									'qty'          => $request->product_qty[$key],
									'cogs'         => $cogs,
									'price'        => $request->product_price[$key],
									'target_price' => str_replace(',','.',str_replace('.','',str_replace('IDR ','',$request->product_target_price[$key]))),
									'unit'         => $request->product_unit[$key]
								]);
							}else{
								ProjectProduct::create([
									'project_id'   => $query->id,
									'product_id'   => $pi,
									'area'   	   => $request->product_area[$key],
									'qty'          => $request->product_qty[$key],
									'cogs'         => $cogs,
									'price'        => $request->product_price[$key],
									'target_price' => str_replace(',','.',str_replace('.','',str_replace('IDR ','',$request->product_target_price[$key]))),
									'unit'         => $request->product_unit[$key]
								]);
							}
                            
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
						
						ProjectConsultantMeeting::whereNotIn('id',$request->consultant_id)->delete();
						
                        foreach($request->consultant_date as $key => $cd) {
							if($request->consultant_id[$key] !== '0'){
								
							}else{
								ProjectConsultantMeeting::create([
									'project_id' => $query->id,
									'date'       => $cd,
									'person'     => $request->consultant_person[$key],
									'result'     => $request->consultant_result[$key]
								]);
							}
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
						
						$revision = ProjectQuotation::where('project_id', $query->id)->max('revision');
						$revision++;

						$projectQuotation = ProjectQuotation::create([
							'project_id'     => $query->id,
							'revision'  	 => $revision,
							'approved_by_1'  => 0,
							'approved_by_1'  => 0
						]);

                        foreach($request->project_product_id as $key => $ppi) {
                            ProjectProduct::find($ppi)->update([
                                'recommended_price' => str_replace(',','.',str_replace('.','',str_replace('IDR ','',$request->product_recommended_price[$key]))),
								'best_price' => str_replace(',','.',str_replace('.','',str_replace('IDR ','',$request->product_best_price[$key]))),
                                'discount' => str_replace(',','.',str_replace('.','',$request->product_discount[$key]))
                            ]);
							
							ProjectQuotationProduct::create([
								'project_quotation_id'     	=> $projectQuotation->id,
								'product_id'  	 			=> $ppi,
								'recommended_price'  		=> str_replace(',','.',str_replace('.','',str_replace('IDR ','',$request->product_recommended_price[$key]))),
								'best_price' 				=> str_replace(',','.',str_replace('.','',str_replace('IDR ','',$request->product_best_price[$key]))),
								'discount'					=> str_replace(',','.',str_replace('.','',$request->product_discount[$key]))
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
						
						ProjectSample::where('project_id',$query->id)->whereNotIn('product_id',$request->sample_product_id)->delete();
						
                        foreach($request->sample_product_id as $key => $spi) {
							if($request->sample_id[$key] !== '0'){
							
							}else{
								ProjectSample::create([
									'project_id' => $query->id,
									'product_id' => $spi,
									'date'       => $request->sample_date[$key],
									'qty'        => $request->sample_qty[$key],
									'unit'       => $request->sample_unit[$key],
									'size'       => $request->sample_size[$key]
								]);
							}
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

                        /* foreach($request->project_product_id as $key => $ppi) {
                            ProjectProduct::find($ppi)->update([
								'best_price' => str_replace(',','.',str_replace('.','',str_replace('IDR ','',$request->product_best_price[$key]))),
                                'discount' => str_replace(',','.',str_replace('.','',$request->product_discount[$key]))
                            ]);
                        } */

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 6)');
                        break;

                    case 'step-7':
                        $query->update([
                            'progress' => $query->progress < 40 ? 40 : $query->progress
                        ]);
						
						$rowcek = Project::find($query->id);
						
						if($rowcek->so_file){
							Storage::delete($rowcek->so_file);
						}
						
						Project::find($query->id)->update([
							'so_file'	=> $request->file('file')->store('public/project')
						]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 7)');
                        break;

                    case 'step-8':
                        $query->update([
                            'progress' => $query->progress < 43 ? 43 : $query->progress
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 8)');
                        break;

                    case 'step-9':
                        $query->update([
                            'progress' => $query->progress < 45 ? 45 : $query->progress
                        ]);

                        ProjectPayment::create([
                            'project_id' => $query->id,
                            'image'      => $request->file('image')->store('public/project'),
                            'date'       => $request->date,
                            'nominal'    => str_replace(',','.',str_replace('.','',$request->nominal)),
                            'bank'       => $request->bank,
                            'status'     => 1
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 9)');
                        break;

                    case 'step-10':
                        $query->update([
                            'progress' => $query->progress < 50 ? 50 : $query->progress
                        ]);

                        ProjectProduction::create([
                            'project_id'  => $query->id,
                            'image'       => $request->file('image')->store('public/project'),
                            'start_date'  => $request->start_date,
                            'finish_date' => $request->finish_date,
                            'note'        => $request->note,
							'progress'	  => $request->progress_production
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 10)');
                        break;

                    case 'step-11':
                        $query->update([
                            'progress' => $query->progress < 55 ? 55 : $query->progress
                        ]);

                        ProjectPayment::create([
                            'project_id' => $query->id,
                            'image'      => $request->file('image')->store('public/project'),
                            'date'       => $request->date,
                            'nominal'    => str_replace(',','.',str_replace('.','',$request->nominal)),
                            'bank'       => $request->bank,
                            'status'     => 2
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 11)');
                        break;

                    case 'step-12':
                        $query->update([
                            'progress' => $query->progress < 60 ? 60 : $query->progress
                        ]);

                        ProjectShipment::create([
                            'project_id'     => $query->id,
                            'loading_date'   => $request->loading_date,
                            'departure_date' => $request->departure_date,
                            'from_port'      => $request->from_port,
                            'to_port'        => $request->to_port,
                            'eta'            => $request->eta,
                            'note'           => $request->note
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 12)');
                        break;
					
					case 'step-13':
					
						$query->update([
                            'progress' => $query->progress < 65 ? 65 : $query->progress
                        ]);

                        ProjectWarehouse::create([
                            'project_id'     => $query->id,
                            'image'      	 => $request->file('image')->store('public/project'),
                            'date_receive' 	 => $request->date_receive,
                            'warehouse_id'   => $request->warehouse_id,
                            'person'         => $request->person
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 13)');
						break;
						
					case 'step-14':
						
					
						break;
					
                    case 'step-15':
                        $query->update([
                            'progress' => $query->progress < 75 ? 75 : $query->progress
                        ]);

                        $total_weight = 0;
                        foreach($query->projectProduct as $pp) {
                            $total_weight += $pp->product->type->weight * $pp->qty;
                        }

                        $delivery     = Delivery::find($request->delivery_id);
                        $shipping_fee = $delivery->price_per_kg * $total_weight;

                        ProjectDelivery::create([
                            'project_id'    => $query->id,
                            'city_id'       => $request->city_id,
                            'delivery_id'   => $request->delivery_id,
                            'receiver_name' => $request->receiver_name,
                            'delivery_date' => $request->delivery_date,
                            'email'         => $request->email,
                            'phone'         => $request->phone,
                            'address'       => $request->address,
                            'price'         => $shipping_fee
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 15)');
                        break;
					
					case 'step-16':
						
					
						break;
					
                    case 'step-17':
                        $query->update([
                            'progress' => $query->progress < 90 ? 90 : $query->progress
                        ]);

                        ProjectPay::create([
                            'project_id'     => $query->id,
                            'image'          => $request->file('image')->store('public/project'),
                            'date'           => $request->date,
                            'nominal'        => str_replace(',','.',str_replace('.','',$request->nominal)),
                            'payment'        => $request->payment,
                            'payment_method' => $request->payment_method
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 17)');
                        break;

                    case 'step-18':
                        $query->update([
                            'progress' => $query->progress < 100 ? 100 : $query->progress
                        ]);

                        activity()
                            ->performedOn(new Project())
                            ->causedBy(session('bo_id'))
                            ->log('Change data project ' . $query->name . ' (Step 18)');
                        break;
                }

                return redirect('admin/sales/project/progress/' . $id . '?' . $step . '=1#' . $step)
                    ->with(['success' => 'Data successfully saved.']);
            }
        } else {
            $data = [
                'title'   => 'Progress Data Project',
                'country' => Country::where('status', 1)->get(),
                'city'    => City::all(),
                'project' => $query,
                'content' => 'admin.sales.project_progress'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function print($param, $id)
    {
        $project_id = base64_decode($id);
        $project    = Project::find($project_id);

        if(!$project) {
            abort(404);
        }

        if($param == 'quotation_order'){
			$pdf = PDF::loadView('admin.pdf.project.' . $param, [
					'project' => $project,
					'brand'   => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get()
				],
				[],
				[ 
				  'format' => 'A4-P',
				  'orientation' => 'P'
				]
			);
		}else if($param == 'negotiation_order'){
			$pdf = PDF::loadView('admin.pdf.project.' . $param, [
					'project' => $project,
					'brand'   => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get()
				],
				[],
				[ 
				  'format' => 'A3-L',
				  'orientation' => 'L'
				]
			);
		}else if($param == 'sample_order' || $param == 'purchase_order'){
			$pdf = PDF::loadView('admin.pdf.project.' . $param, [
					'project' => $project,
					'brand'   => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get()
				],
				[],
				[ 
				  'format' => 'A4-L',
				  'orientation' => 'L'
				]
			);
		}else{
			$pdf = PDF::loadView('admin.pdf.project.' . $param, [
				'project' => $project,
				'brand'   => Brand::whereIn('code', ['TR', 'FI', 'SM', 'BT'])->get()
			]);
		}

        return $pdf->stream('Invoice Project ' . str_replace('/', '-', $project->code) . '.pdf');
    }

}
