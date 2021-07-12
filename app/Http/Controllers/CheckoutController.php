<?php

namespace App\Http\Controllers;

use QrCode;
use Xendit\Invoice;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Delivery;
use App\Jobs\EmailProcess;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OrderShipping;
use App\Models\ProductShading;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller {
    
    public function index(Request $request, $param)
    {
        $customer = Customer::find(session('fo_id'));
        if(!session('fo_id') || !$customer) {
            return redirect('account/login');
        } else if($customer->cart->count() < 1) {
            return redirect('product');
        } else if(empty($param)) {
            return redirect('cart');
        }

        if($request->has('_token') && session()->token() == $request->_token) {
            if($param == 'cashless') {
                $validation = Validator::make($request->all(), [
                    'receiver_name' => 'required',
                    'email'         => 'required|email',
                    'phone'         => 'required|min:9|numeric',
                    'city_id'       => 'required',
                    'address'       => 'required',
                    'delivery_id'   => 'required'
                ], [
                    'receiver_name.required' => 'Receiver name cannot be empty.',
                    'email.required'         => 'Email cannot be empty.',
                    'email.email'            => 'Email not valid.',
                    'phone.required'         => 'Phone cannot be empty',
                    'phone.min'              => 'Phone must be at least 9 characters long',
                    'phone.numeric'          => 'Phone must be number',
                    'city_id.required'       => 'Please select a city.',
                    'address.required'       => 'Address cannot be empty.',
                    'delivery_id.required'   => 'Please select a transport.'
                ]);

                if($validation->fails()) {
                    return redirect()->back()->withErrors($validation)->withInput();
                }
            }

            $total_checkout = 0;
            $total_weight   = 0;
            $param_code     = $param == 'cash' ? 'CH' : 'CS';
            $order          = Order::create([
                'customer_id' => session('fo_id'),
                'number'      => Order::generateNumber($param_code),
                'invoice'     => $param == 'cash' ? Order::generateCode('INV', 'invoice') : null,
                'description' => $request->description,
                'type'        => $param == 'cash' ? 1 : 2,
                'status'      => 1
            ]);

            foreach($customer->cart as $c) {
                $formula         = $c->product->cogs;
                $pricing         = $c->product->pricingPolicy;
                $showroom_cost   = $pricing ? $pricing->showroom_cost : 0;
                $marketing_cost  = $pricing ? $pricing->marketing_cost : 0;
                $bottom_price    = $pricing ? $pricing->bottom_price : 0;
                $fixed_cost      = $pricing ? $pricing->fixed_cost : 0;
                $cogs_idr        = $formula ? $formula->cogs_idr : 0;
                $cogs_pta_idr    = $formula ? $formula->cogs_pta_idr : 0;
                $cogs_smb_idr    = $formula ? $formula->cogs_smb_idr : 0;
                $subtotal        = $c->product->price() * $c->qty;
                $total_checkout += $subtotal;
                $total_weight   += $c->product->type->weight * $c->qty;
                
                OrderDetail::create([
                    'order_id'         => $order->id,
                    'product_id'       => $c->product_id,
                    'showroom_cost'    => $showroom_cost,
                    'marketing_cost'   => $marketing_cost,
                    'bottom_price'     => $bottom_price,
                    'fixed_cost'       => $fixed_cost,
                    'price_list'       => $c->product->price(),
                    'target_price'     => $subtotal,
                    'cogs_perwira'     => $cogs_pta_idr,
                    'cogs_smartmarble' => $cogs_smb_idr,
                    'profit'           => $subtotal - $cogs_idr,
                    'qty'              => $c->qty,
                    'total'            => $subtotal
                ]);
            }

            Cart::where('customer_id', session('fo_id'))->delete();
            if($param == 'cash') {
                $generate = QrCode::format('png')->merge('/public/website/icon.png')->size(200)->generate($order->number);
                $qr_code  = 'public/order/SMB-QrCode-' . str_replace('/', '', $order->number) . '.png';

                Storage::put($qr_code, $generate);
                Order::find($order->id)->update(['qr_code' => $qr_code, 'subtotal' => $total_checkout, 'grandtotal' => $total_checkout]);

                $payload = [
                    'email'      => $customer->email,
                    'name'       => $customer->name,
                    'order'      => Order::find($order->id),
                    'link'       => url('account/history_order/detail/' . base64_encode($order->id)),
                    'view'       => 'order_cash',
                    'subject'    => 'SMB | Order ' . $order->number
                ];

                dispatch(new EmailProcess($payload));
                return redirect('checkout/notif/success?number=' . base64_encode($order->number));
            } else {
                $delivery     = Delivery::find($request->delivery_id);
                $shipping_fee = $delivery->price_per_kg * $total_weight;
                $grandtotal   = $total_checkout + $shipping_fee;

                OrderShipping::create([
                    'order_id'      => $order->id,
                    'city_id'       => $request->city_id,
                    'delivery_id'   => $request->delivery_id,
                    'receiver_name' => $request->receiver_name,
                    'email'         => $request->email,
                    'phone'         => $request->phone,
                    'address'       => $request->address
                ]);

                $param_invoice = [
                    'external_id'          => $order->number,
                    'payer_email'          => $request->email,
                    'description'          => $request->description ? $request->description : 'No Description',
                    'amount'               => $grandtotal,
                    'should_send_email'    => true,
                    'success_redirect_url' => url('checkout/notif/success?number=' . base64_encode($order->number)),
                    'failure_redirect_url' => url('checkout/notif/failed?number=' . base64_encode($order->number)),
                    'currency'             => 'IDR'
                ];

                $generate_invoice = Invoice::create($param_invoice);
                Order::find($order->id)->update([
                    'xendit'     => json_encode(['id' => $generate_invoice['id'], 'url' => $generate_invoice['invoice_url']]),
                    'subtotal'   => $total_checkout,
                    'shipping'   => $shipping_fee,
                    'grandtotal' => $grandtotal
                ]);

                return redirect($generate_invoice['invoice_url']);
            }
        } else {
            $data = [
                'title'    => 'Checkout',
                'customer' => $customer,
                'city'     => City::orderBy('name', 'asc')->get()
            ];

            return view('checkout.' . $param, $data);
        }
    }

    public function getDelivery(Request $request)
    {
        $data     = [];
        $city_id  = $request->city_id;
        $weight   = (double)$request->weight;
        $delivery = Delivery::where('destination_id', $city_id)
            ->where('capacity', '>=', $weight)
            ->orderBy('capacity', 'asc')
            ->orderBy('price_per_kg', 'asc')
            ->groupBy('transport_id')
            ->get();

        foreach($delivery as $d) {
            $data[] = [
                'id'             => $d->id,
                'price'          => 'Rp ' . number_format($d->price_per_kg * $weight, '0', ',', '.'),
                'transport_name' => $d->transport->fleet
            ];
        }

        return response()->json($data);
    }

    public function grandtotal(Request $request)
    {
        $subtotal     = (double)$request->subtotal;
        $weight       = (double)$request->weight;
        $delivery     = Delivery::find($request->delivery_id);
        $shipping_fee = $delivery ? $delivery->price_per_kg * $weight : 0;
        $transport    = $delivery ? $delivery->transport->fleet : 'Not Selected';
        $grandtotal   = $subtotal + $shipping_fee;

        return response()->json([
            'transport'    => $transport,
            'shipping_fee' => 'Rp ' . number_format($shipping_fee, '0', ',', '.'),
            'grandtotal'   => 'Rp ' . number_format($grandtotal, '0', ',', '.')
        ]);
    }

    public function notif(Request $request, $param)
    {
        $number = base64_decode($request->number);
        $order  = Order::where('number', $number)->first();

        if(!session('fo_id')) {
            return redirect('account/login');
        } else if(!$order) {
            return redirect('/');
        }

        $data = [
            'title'   => 'Order Notification',
            'order'   => $order,
            'content' => 'checkout.' . $param
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
