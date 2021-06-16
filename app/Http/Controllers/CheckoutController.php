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
use App\Models\ProductShading;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
                'number'      => Order::generateNumber('RTL'),
                'code'        => Order::generateCode('RTL'),
                'type'        => 1,
                'status'      => 1
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

            $generate = QrCode::format('png')->merge('/public/website/icon.png')->size(200)->generate($order->number);
            $qr_code  = 'public/order/SMB-QrCode-' . str_replace('/', '', $order->number) . '.png';
            Storage::put($qr_code, $generate);

            Order::find($order->id)->update(['qr_code' => $qr_code, 'subtotal' => $total, 'grandtotal' => $total]);
            Cart::where('customer_id', session('fo_id'))->delete();

            $payload  = [
                'email'      => $customer->email,
                'name'       => $customer->name,
                'order'      => Order::find($order->id),
                'attachment' => true,
                'link'       => url('account/history_order/detail/' . base64_encode($order->id)),
                'view'       => 'order_cash',
                'subject'    => 'SMB | Order ' . $order->number
            ];

            dispatch(new EmailProcess($payload));
            return redirect('checkout/cash/cash_success?number=' . base64_encode($order->number));
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
        $number = base64_decode($request->number);
        $order  = Order::where('number', $number)->first();

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

    public function cashlessGetDelivery(Request $request)
    {
        $data     = [];
        $city_id  = $request->city_id;
        $weight   = (double)$request->weight;
        $delivery = Delivery::where('destination_id', $city_id)
            ->where('capacity', '>=', $weight)
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

    public function cashlessGrandtotal(Request $request)
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

    public function cashless(Request $request)
    {
        $customer = Customer::find(session('fo_id'));
        if(!session('fo_id') || !$customer) {
            return redirect('account/login');
        } else if($customer->cart->count() < 1) {
            return redirect('product');
        }
        
        if($request->has('_token') && session()->token() == $request->_token) {
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
            } else {
                $params = [
                    'external_id' => 'demo_147580196270',
                    'payer_email' => 'sample_email@xendit.co',
                    'description' => 'Trip to Bali',
                    'amount'      => 32000
                ];

                $createInvoice = Invoice::create($params);
                return redirect($createInvoice['invoice_url']);
            }
        } else {
            $data = [
                'title'    => 'Checkout',
                'customer' => $customer,
                'city'     => City::orderBy('name', 'asc')->get(),
                'content'  => 'checkout.cashless'
            ];
    
            return view('layouts.index', ['data' => $data]);
        }
        
    }

}
