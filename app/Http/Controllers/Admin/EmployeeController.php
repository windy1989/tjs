<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Employee',
            'content' => 'admin.hrd.employee'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
