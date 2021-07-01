<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPo;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Models\OrderDelivery;

class WebHookController extends Controller {
    
    public function xendit(Request $request)
    {
        $order = Order::where('number', $request->external_id)->first();
        if($request->status == 'PAID') {
            Order::find($order->id)->update([
                'payment' => $request->amount,
                'status'  => 2
            ]);

            OrderPo::create([
                'order_id'       => $order->id,
                'purchase_order' => OrderPo::generateCode(),
                'status'         => 1
            ]);

            OrderPayment::create([
                'order_id' => $order->id,
                'method'   => $request->payment_method,
                'channel'  => $request->payment_channel
            ]);

            OrderDelivery::create([
                'order_id'       => $order->id,
                'delivery_order' => OrderDelivery::generateCode()
            ]);
        } else if($request->status == 'PENDING') {
            Order::where('number', $request->external_id)->update([
                'status' => 1
            ]);
        } else if($request->status == 'EXPIRED') {
            Order::where('number', $request->external_id)->update([
                'status' => 5
            ]);
        }
    }

}
