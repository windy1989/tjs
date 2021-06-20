<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller {
    
    public function index()
    {
        $data = [
            'title'        => 'Notification',
            'notification' => Notification::where('user_id', session('bo_id'))->paginate(10),
            'content'      => 'admin.notification'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

}
