<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coa;
use App\Models\User;
use App\Models\Journal;
use App\Models\Project;
use App\Models\ProjectSale;
use App\Models\ProjectPurchase;
use App\Models\CashBank;
use Illuminate\Http\Request;
use App\Models\CashBankDetail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CashBankController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Cash & Bank',
			'project' => Project::all(),
            'user'    => User::all(),
            'coa'     => Coa::where('status', 1)->oldest('code')->get(),
            'content' => 'admin.finance.cash_bank'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'detail',
            'id',
            'user_id',
            'code',
            'total',
            'date',
            'description'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = CashBank::count();
        
        $query_data = CashBank::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->whereHas('user', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhere('description', 'like', "%$search%");
                    });
                }     
                
                if($request->user_id) {
                    $query->where('user_id', $request->user_id);
                }

                if($request->start_date && $request->finish_date) {
                    $query->whereDate('date', '>=', $request->start_date)
                        ->whereDate('date', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->whereDate('date', $request->start_date);
                } else if($request->finish_date) {
                    $query->whereDate('date', $request->finish_date);
                }

                if($request->type) {
                    $query->where('type', $request->type);
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = CashBank::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->whereHas('user', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhere('description', 'like', "%$search%");
                    });
                }     
                
                if($request->user_id) {
                    $query->where('user_id', $request->user_id);
                }

                if($request->start_date && $request->finish_date) {
                    $query->whereDate('date', '>=', $request->start_date)
                        ->whereDate('date', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->whereDate('date', $request->start_date);
                } else if($request->finish_date) {
                    $query->whereDate('date', $request->finish_date);
                }

                if($request->type) {
                    $query->where('type', $request->type);
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $response['data'][] = [
                    '<span class="pointer-element badge badge-success" data-id="' . $val->id . '"><i class="icon-plus3"></i></span>',
                    $nomor,
                    $val->user->name,
                    $val->code,
                    number_format($val->cashBankDetail->where('type','1')->sum('nominal'), 2, ',', '.'),
                    date('d F Y', strtotime($val->date)),
                    $val->description,
                    '
						<a href="' . url('admin/finance/cash_bank/print/' . $val->id) . '" class="btn bg-success btn-sm" data-popup="tooltip" title="Print"><i class="icon-printer"></i></a>
                        <button type="button" class="btn bg-warning btn-sm" data-popup="tooltip" title="Edit" onclick="show(' . $val->id . ')"><i class="icon-pencil7"></i></button>
                        <button type="button" class="btn bg-danger btn-sm" data-popup="tooltip" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>
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

    public function suggestCode(Request $request)
    {
        $response = [];
        $data     = CashBank::where('code', 'like', "%$request->search%")
            ->limit(15)
            ->get();

        foreach($data as $d) {
            $response[] = $d->code;
        }

        return response()->json($response);
    }

    public function rowDetail(Request $request)
    {
        $data   = CashBankDetail::where('cash_bank_id', $request->id)->orderBy('type')->get();
        $string = '<table class="table table-bordered">
					<thead class="table-secondary">
						<tr class="text-center">
							<th>Coa</th>
							<th>Debit</th>
							<th>Kredit</th>
							<th>Note</th>
						</tr>
					</thead>
					<tbody>';

        foreach($data as $d) {
			if($d->type == '1'){
				$string .= '
					<tr>
						<td>'.$d->coa->name.'</td>
						<td class="text-center">'.number_format($d->nominal,2,',','.').'</td>
						<td class="text-center">-</td>
						<td>'.$d->note.'</td>
					</tr>
				';
			}elseif($d->type == '2'){
				$string .= '
					<tr>
						<td>'.$d->coa->name.'</td>
						<td class="text-center">-</td>
						<td class="text-center">'.number_format($d->nominal,2,',','.').'</td>
						<td>'.$d->note.'</td>
					</tr>
				';
			}
        }

        $string .= '</tbody></table>';
		
        return response()->json($string);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code'           => 'required|unique:cash_banks,code',
            'coa_detail'	 => 'required',
            'type_detail' 	 => 'required',
            'nominal_detail' => 'required',
            'date'           => 'required',
            'type'           => 'required',
            'description'    => 'required'
        ], [
            'code.required'           => 'Code cannot be a empty.',
            'code.unique'             => 'Code already exists.',
            'coa_detail.required'     => 'Coa transaction cannot be a empty.',
            'type_detail.required' 	  => 'Type transaction cannot be a empty.',
            'nominal_detail.required' => 'Detail transaction cannot be a empty.',
            'date.required'           => 'Date cannot be empty.',
            'type.required'           => 'Please select a type.',
            'description.required'    => 'Description cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = CashBank::create([
                'user_id'     		=> session('bo_id'),
				'project_id'  		=> $request->project_id,
				'project_detail_id'	=> $request->project_detail,
				'reference'			=> $request->reference,
                'code'        		=> $request->code,
                'date'        		=> $request->date,
                'type'        		=> $request->type,
                'description' 		=> $request->description
            ]);

            if($query) {
                foreach($request->coa_detail as $key => $dd) {
                    CashBankDetail::create([
                        'cash_bank_id' 	=> $query->id,
                        'coa_id'       	=> $dd,
                        'type'       	=> $request->type_detail[$key],
                        'nominal'      	=> str_replace(',','.',str_replace('.','',$request->nominal_detail[$key])),
                        'note'         	=> $request->note_detail[$key]
                    ]);

                    Journal::insert([
                        'journalable_type' => 'cash_banks',
                        'journalable_id'   => $query->id,
                        'coa_id'           => $dd,
                        'type'	           => $request->type_detail[$key],
                        'nominal'          => str_replace(',','.',str_replace('.','',$request->nominal_detail[$key])),
                        'created_at'       => date('Y-m-d', strtotime($query->date)) . ' ' . date('H:i:s'),
                        'updated_at'       => date('Y-m-d H:i:s')
                    ]);
                }

                activity()
                    ->performedOn(new CashBank())
                    ->causedBy(session('bo_id'))
                    ->withProperties($query)
                    ->log('Add accounting cash & bank data');

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

    public function show(Request $request)
    {
        $data             = CashBank::find($request->id);
        $cash_bank_detail = [];

        foreach($data->cashBankDetail as $cbd) {
            $cash_bank_detail[] = [
                'coa_id'    	=> $cbd->coa_id,
                'coa_info'  	=> '[' . $cbd->coa->code . '] ' . $cbd->coa->name,
                'type'   		=> $cbd->type,
                'nominal'     	=> number_format($cbd->nominal,2,',','.'),
                'note'       	=> $cbd->note
            ];
        }

        return response()->json([
			'project_id'	   => $data->project_id,
			'reference'		   => $data->reference,
			'reference_id'	   => $data->project_detail_id,
			'reference_code'   => $data->reference == '1' ? $data->projectSale->code : ($data->reference == '2' ? $data->projectPurchase->code : ''),
			'reference_total'  => $data->reference == '1' ? $data->projectSale->getTotal() : ($data->reference == '2' ? $data->projectPurchase->getTotal() : ''),
            'code'             => $data->code,
            'date'             => $data->date,
            'type'             => $data->type,
            'description'      => $data->description,
            'cash_bank_detail' => $cash_bank_detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $query      = CashBank::find($id);
		$validation = Validator::make($request->all(), [
            'code'           => ['required', Rule::unique('cash_banks', 'code')->ignore($id)],
            'coa_detail'	 => 'required',
            'type_detail' 	 => 'required',
            'nominal_detail' => 'required',
            'date'           => 'required',
            'type'           => 'required',
            'description'    => 'required'
        ], [
            'code.required'           => 'Code cannot be a empty.',
            'code.unique'             => 'Code already exists.',
            'coa_detail.required'     => 'Coa transaction cannot be a empty.',
            'type_detail.required' 	  => 'Type transaction cannot be a empty.',
            'nominal_detail.required' => 'Detail transaction cannot be a empty.',
            'date.required'           => 'Date cannot be empty.',
            'type.required'           => 'Please select a type.',
            'description.required'    => 'Description cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query->update([
                'user_id'     		=> session('bo_id'),
				'project_id'  		=> $request->project_id,
				'project_detail_id'	=> $request->project_detail,
				'reference'			=> $request->reference,
                'code'        		=> $request->code,
                'date'        		=> $request->date,
                'type'       		=> $request->type,
                'description' 		=> $request->description
            ]);

            if($query) {
                CashBankDetail::where('cash_bank_id', $query->id)->delete();
                DB::table('journals')
                    ->where('journalable_type', 'cash_banks')
                    ->where('journalable_id', $query->id)
                    ->delete();

                foreach($request->coa_detail as $key => $dd) {
                    CashBankDetail::create([
                        'cash_bank_id' 	=> $query->id,
                        'coa_id'       	=> $dd,
                        'type'       	=> $request->type_detail[$key],
                        'nominal'      	=> str_replace(',','.',str_replace('.','',$request->nominal_detail[$key])),
                        'note'         	=> $request->note_detail[$key]
                    ]);

                    Journal::insert([
                        'journalable_type' => 'cash_banks',
                        'journalable_id'   => $query->id,
                        'coa_id'           => $dd,
                        'type'	           => $request->type_detail[$key],
                        'nominal'          => str_replace(',','.',str_replace('.','',$request->nominal_detail[$key])),
                        'created_at'       => date('Y-m-d', strtotime($query->date)) . ' ' . date('H:i:s'),
                        'updated_at'       => date('Y-m-d H:i:s')
                    ]);
                }

                activity()
                    ->performedOn(new CashBank())
                    ->causedBy(session('bo_id'))
                    ->log('Change the accounting cash bank data');

                $response = [
                    'status'  => 200,
                    'message' => 'Data updated successfully.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data failed to update.'
                ];
            }
        }

        return response()->json($response);
    }
	
	public function print($id)
    {
        $data = [
            'title'     => 'Cash & Bank Print',
            'cash_bank' => CashBank::find($id),
            'content'   => 'admin.finance.cash_bank_print'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function destroy(Request $request) 
    {
        $query = CashBank::find($request->id);
        if($query->delete()) {
            DB::table('journals')
                ->where('journalable_type', 'cash_banks')
                ->where('journalable_id', $query->id)
                ->delete();
                    
            activity()
                ->performedOn(new CashBank())
                ->causedBy(session('bo_id'))
                ->log('Delete the accounting cash bank data');

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
	
	public function getProject(Request $request){
		$reference = $request->reference;
		
		if($reference == '1'){
			$data = ProjectSale::where('project_id',$request->id)->get();
		}elseif($reference == '2'){
			$data = ProjectPurchase::where('project_id',$request->id)->get();
		}
		
		$result = [];
		
		foreach($data as $row){
			$result[] = [
				'id'	=> $row->id,
				'code' 	=> $row->code,
				'total'	=> $row->getTotal()
			];
		}
		
		return response()->json($result);
	}
}
