<?php

namespace App\Http\Controllers;

use QrCode;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Customer;
use App\Jobs\EmailProcess;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductShading;

class CheckoutController extends Controller {
    
    public function cash(Request $request)
    {
        $customer = Customer::find(session('fo_id'));
        if(!session('fo_id') || !$customer) {
            return redirect('account/login');
        } else if($customer->cart->count() < 1) {
            return redirect('product');
        }

        if($request->has('_token') && session()->token() == $request->_token) {
            $order = Order::create([
                'customer_id' => session('fo_id'),
                'code'        => Order::generateCode('RTL'),
                'type'        => 1
            ]);

            $total = 0;
            foreach($customer->cart as $c) {
                $formula        = $c->product->cogs;
                $pricing        = $c->product->pricingPolicy;
                $showroom_cost  = $pricing ? $pricing->showroom_cost : 0;
                $marketing_cost = $pricing ? $pricing->marketing_cost : 0;
                $bottom_price   = $pricing ? $pricing->bottom_price : 0;
                $fixed_cost     = $pricing ? $pricing->fixed_cost : 0;
                $cogs_idr       = $formula ? $formula->cogs_idr : 0;
                $cogs_pta_idr   = $formula ? $formula->cogs_pta_idr : 0;
                $cogs_smb_idr   = $formula ? $formula->cogs_smb_idr : 0;
                $subtotal       = $c->product->price() * $c->qty;
                $total         += $subtotal;

                $request = abs($c->qty);
                $indent  = 0;
                $stock   = $c->product->productShading->sum('qty');

                if($request > $stock) {
                    $indent = $request - $stock;
                }

                $ready   = abs($request - $indent);
                $shading = ProductShading::where('product_id', $c->product->id)->orderBy('qty', 'asc')->get();

                foreach($shading as $s) {
                    $minus = $s->qty - $ready;
                    ProductShading::find($s->id)->update(['qty' => $minus > 0 ? $minus : 0]);

                    if($ready > 0) {
                        $s->qty - $ready;
                    }
                }
                
                OrderDetail::create([
                    'order_id'         => $order->id,
                    'product_id'       => $c->product_id,
                    'showroom_cost'    => $showroom_cost,
                    'marketing_cost'   => $marketing_cost,
                    'bottom_price'     => $bottom_price,
                    'fixed_cost'       => $fixed_cost,
                    'price_list'       => $c->product->price(),
                    'cogs_perwira'     => $cogs_pta_idr,
                    'cogs_smartmarble' => $cogs_smb_idr,
                    'profit'           => $subtotal - $cogs_idr,
                    'qty'              => $request,
                    'ready'            => $ready,
                    'indent'           => $indent,
                    'total'            => $subtotal
                ]);
            }

            Order::find($order->id)->update(['subtotal' => $total, 'grandtotal' => $total]);
            Cart::where('customer_id', session('fo_id'))->delete();

            $payload  = [
                'email'   => $customer->email,
                'name'    => $customer->name,
                'order'   => Order::find($order->id),
                'link'    => url('account/history_order/detail/' . base64_encode($order->id)),
                'view'    => 'order_cash',
                'subject' => 'SMB | Invoice #' . $order->code
            ];

            dispatch(new EmailProcess($payload));

            return redirect('checkout/cash/cash_success?code=' . base64_encode($order->code));
        } else {
            $data = [
                'title'    => 'Checkout',
                'customer' => $customer,
                'content'  => 'checkout.cash'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

    public function cashSuccess(Request $request)
    {
        $code  = base64_decode($request->code);
        $order = Order::where('code', $code)->first();

        if(!session('fo_id')) {
            return redirect('account/login');
        } else if(!$order) {
            return redirect('/');
        }

        $data = [
            'title'   => 'Order Successfully Created',
            'order'   => $order,
            'content' => 'checkout.cash_success'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
