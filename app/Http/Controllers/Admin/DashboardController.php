<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Admin - Dashboard',
            'content' => 'admin.dashboard'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }
    
}
