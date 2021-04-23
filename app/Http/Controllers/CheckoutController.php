<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

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
             
        } else {
            $data = [
                'title'    => 'Checkout',
                'customer' => $customer,
                'content'  => 'checkout.cash'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

}
