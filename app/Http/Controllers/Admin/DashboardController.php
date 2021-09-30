<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function __construct()
    {
        $this->middleware('admin.role:1,2');
    }

    public function index()
    {
        $data = [
            'title'   => 'Dashboard',
            'content' => 'admin.dashboard'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }
    
}
