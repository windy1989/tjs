<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Project',
            'content' => 'admin.project'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
