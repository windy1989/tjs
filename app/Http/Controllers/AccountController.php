<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Token;
use App\Models\Customer;
use App\Jobs\EmailProcess;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller {
    
    public function login(Request $request)
    {
        if(session('fo_id')) {
            return redirect('/');
        }

        if($request->has('_token') && session()->token() == $request->_token) {
            $account = Customer::where('email', $request->email)->first();
            if($account) {
                if($account->verification) {
                    if(Hash::check($request->password, $account->password)) {
                        session([
                            'fo_id'           => $account->id,
                            'fo_photo'        => $account->photo,
                            'fo_name'         => $account->name,
                            'fo_email'        => $account->email,
                            'fo_verification' => $account->verification
                        ]);

                        return redirect('/');
                    } else {
                        return redirect()->back()->with(['failed' => 'Account not found']);
                    }
                } else {
                    return redirect()->back()->with(['info' => 'Account not verified']);
                }
            } else {
                return redirect()->back()->with(['failed' => 'Account not found']);
            }
        } else {
            $data = [
                'title'   => 'Login Customer',
                'content' => 'account.login'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

    public function register(Request $request)
    {
        if(session('fo_id')) {
            return redirect('/');
        }

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

                $token = Token::create([
                    'tokenable_type' => 'customers',
                    'tokenable_id'   => $query->id,
                    'token'          => Str::random(45),
                    'type'           => 1,
                    'valid'          => date('Y-m-d H:i:s', strtotime('+1 day')),
                    'status'         => 1
                ]);

                $payload = [
                    'name'    => $query->name,
                    'email'   => $query->email,
                    'link'    => url('account/verification?token=' . base64_encode($token->token)),
                    'view'    => 'verification',
                    'subject' => 'SMB | Verification Account'
                ];

                dispatch(new EmailProcess($payload));
                return redirect('account/login')->with(['success' => 'Please check email for account verification, valid 1 day']);
            }
        } else {
            $data = [
                'title'   => 'Registrasi New Customer',
                'content' => 'account.register'
            ];
    
            return view('layouts.index', ['data' => $data]);
        }
    }

    public function verification(Request $request)
    {
        if(session('fo_id')) {
            return redirect('/');
        }
        
        $token = base64_decode($request->token);
        $data  = Token::where('token', $token)
            ->where('tokenable_type', 'customers')
            ->where('type', 1)
            ->where('status', 1)
            ->first();

        if($data) {
            if(date('Y-m-d H:i:s') <= $data->valid) {
                Token::find($data->id)->update(['status' => 2]);
                Customer::find($data->tokenable_id)->update(['verification' => date('Y-m-d H:i:s')]);
                return redirect('account/login')->with(['success' => 'Your account is verified']);
            }
        }

        return redirect('/');
    }

    public function forgotPassword(Request $request)
    {
        $account = Customer::where('email', $request->email)->whereNotNull('verification')->first();
        if($account) {
            Token::where('tokenable_type', 'customers')
                ->where('tokenable_id', $account->id)
                ->where('type', 2)
                ->update(['status' => 2]);

            $token = Token::create([
                'tokenable_type' => 'customers',
                'tokenable_id'   => $account->id,
                'token'          => Str::random(45),
                'type'           => 2,
                'valid'          => date('Y-m-d H:i:s', strtotime('+1 day')),
                'status'         => 1
            ]);

            $payload = [
                'name'    => $account->name,
                'email'   => $account->email,
                'link'    => url('account/reset_password?token=' . base64_encode($token->token)),
                'view'    => 'reset_password',
                'subject' => 'SMB | Reset Password'
            ];

            dispatch(new EmailProcess($payload));
            
            $response = [
                'status'  => true,
                'message' => 'The password reset link has been successfully sent to your email, valid 1 day'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Email not registered'
            ];
        }

        return response()->json($response);
    }

    public function resetPassword(Request $request)
    {
        $token    = base64_decode($request->token);
        $customer = Token::where('token', $token)
            ->where('tokenable_type', 'customers')
            ->where('type', 2)
            ->where('status', 1)
            ->first();

        if($customer) {
            if($request->has('_token') && session()->token() == $request->_token) {
                $validation = Validator::make($request->all(), [
                    'password'              => 'required',
                    'password_confirmation' => 'required|same:password'
                ], [
                    'password.required'              => 'Password cannot be empty',
                    'password_confirmation.required' => 'Password confirmation cannot be empty',
                    'password_confirmation.same'     => 'Password confirmation not match with password',
                ]);

                if($validation->fails()) {
                    return redirect()->back()->withErrors($validation);
                } else {
                    $query = Customer::find($customer->tokenable_id)->update([
                        'password' => bcrypt($request->password)
                    ]);

                    return redirect('account/login')->with(['success' => 'Password successfully reset']);
                }
            } else {
                $data = [
                    'title'   => 'Reset Password',
                    'content' => 'account.reset_password'
                ];
        
                return view('layouts.index', ['data' => $data]);
            }
        }

        return redirect('/');
    }

    public function loginSocialMedia(Request $request)
    {
        return Socialite::driver($request->submit)->redirect();
    }

    public function loginSocialMediaCallback(Request $request, $param)
    {
        if($param) {
            if($param == 'google' || $param == 'facebook') {
                $data         = Socialite::driver($param)->user();
                $account      = Customer::where('email', $data->getEmail())->first();
                $verification = date('Y-m-d H:i:s');

                if($account) {
                    if(!$account->verification) {
                        Customer::find($account->id)->update(['verification' => $verification]);
                        $account->verification = $verification;
                    }

                    session([
                        'fo_id'           => $account->id,
                        'fo_photo'        => $account->photo,
                        'fo_name'         => $account->name,
                        'fo_email'        => $account->email,
                        'fo_verification' => $account->verification
                    ]);
                } else {
                    $account = Customer::create([
                        'photo'        => $data->getAvatar(),
                        'name'         => $data->getName(),
                        'email'        => $data->getEmail(),
                        'verification' => date('Y-m-d H:i:s')
                    ]);

                    session([
                        'fo_id'           => $account->id,
                        'fo_photo'        => $account->photo,
                        'fo_name'         => $account->name,
                        'fo_email'        => $account->email,
                        'fo_verification' => $verification
                    ]);
                }

                return redirect('/');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

}
