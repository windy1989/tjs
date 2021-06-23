<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;

class WebHookController extends Controller {
    
    public function xendit(Request $request)
    {
        $order = Order::where('number', $request->external_id)->first();
        if($response->status == 'PAID') {
            Order::find($order->id)->update([
                'payment'        => $request->amount,
                'purchase_order' => Order::generateCode('CS', 'purchase_order'),
                'status'         => 2
            ]);

            OrderPayment::create([
                'order_id' => $order->id,
                'method'   => $request->payment_method,
                'channel'  => $request->payment_channel
            ]);
        } else if($response->status == 'PENDING') {
            Order::where('number', $request->external_id)->update([
                'status' => 1
            ]);
        } else if($response->status == 'EXPIRED') {
            Order::where('number', $request->external_id)->update([
                'status' => 4
            ]);
        }
    }

}
