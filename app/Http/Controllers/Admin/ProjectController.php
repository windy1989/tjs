<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller {
    
    public function index() 
    {
        $data = [
            'title'   => 'Project',
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
                    $action = '<a href="' . url('project/detail/' . $val->id) . '" class="btn bg-warning btn-sm">Detail</a>';
                } else {
                    $action = '<a href="' . url('project/manage/' . $val->id) . '" class="btn bg-warning btn-sm">Manage</a>';
                }

                $response['data'][] = [
                    $nomor,
                    $val->user->name,
                    $val->name,
                    $val->progress . '%',
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

    public function manage(Request $request)
    {
        $data = [
            'title'   => 'Manage Project',
            'country' => Country::where('status', 1)->get(),
            'city'    => City::all(),
            'content' => 'admin.project_manage'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
