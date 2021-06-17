<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WebHookController extends Controller {
    
    public function xendit(Request $request)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($response->status == 'PAID') {
                Order::where('number', $request->external_id)->update([
                    'payment' => $request->amount,
                    'status'  => 2
                ]);
            } else if($response->status == 'PENDING') {
                Order::where('number', $request->external_id)->update([
                    'status' => 1
                ]);
            } else if($response->status == 'EXPIRED') {
                Order::where('number', $request->external_id)->update([
                    'status' => 6
                ]);
            }
        }
    }

}
