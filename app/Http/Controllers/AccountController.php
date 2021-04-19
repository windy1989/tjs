<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller {
    
    public function login(Request $request)
    {
        $data = [
            'title'   => 'Login Customer',
            'content' => 'account.login'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function register(Request $request)
    {
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'name'     => 'required',
                'email'    => 'required|email|unique:customers,email',
                'phone'    => 'required|min:9|numeric',
                'password' => 'required'
            ], [
                'name.required'     => 'Name cannot be empty',
                'email.required'    => 'Email cannot be empty',
                'email.email'       => 'Email not valid',
                'email.unique'      => 'Email exists',
                'phone.required'    => 'Phone cannot be empty',
                'phone.min'         => 'Phone must be at least 9 characters long',
                'phone.numeric'     => 'Phone must be number',
                'password.required' => 'Password cannot be empty'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                $query = Customer::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'phone'    => $request->phone,
                    'password' => bcrypt($request->password)
                ]);

                session([
                    'fo_photo' => $query->photo,
                    'fo_id'    => $query->id,
                    'fo_name'  => $query->name,
                    'fo_email' => $query->email,
                    'fo_phone' => $query->phone
                ]);

                return redirect('/');
            }
        } else {
            $data = [
                'title'   => 'Registrasi New Customer',
                'content' => 'account.register'
            ];
    
            return view('layouts.index', ['data' => $data]);
        }
    }

}
