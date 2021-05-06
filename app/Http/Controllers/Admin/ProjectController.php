<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

}
