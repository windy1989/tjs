<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller {
    
    public function login(Request $request)
    {
        if(session('bo_id')) {
            return redirect('admin/dashboard');
        }

        if($request->has('_token') && session()->token() == $request->_token) {
            $user = User::where('email', $request->email)->first();
            if($user) {
                if($user->verification) {
                    if(Hash::check($request->password, $user->password)) {
                        $role = [];
                        foreach($user->userRole as $ur) {
                            $role[] = $ur;
                        }

                        session([
                            'bo_id'     => $user->id,
                            'bo_photo'  => $user->photo ? asset(Storage::url($user->photo)) : asset('website/user.png'),
                            'bo_name'   => $user->name,
                            'bo_email'  => $user->email,
                            'bo_branch' => $user->branch,
                            'bo_role'   => $role
                        ]);

                        return redirect('admin/dashboard');
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
            return view('admin.auth.login');
        }
    }

    public function verification(Request $request)
    {
        if(session('bo_id')) {
            return redirect('admin/dashboard');
        }
        
        $token = base64_decode($request->token);
        $data  = Token::where('token', $token)
            ->where('tokenable_type', 'users')
            ->where('type', 1)
            ->where('status', 1)
            ->first();

        if($data) {
            if(date('Y-m-d H:i:s') <= $data->valid) {
                Token::find($data->id)->update(['status' => 2]);
                User::find($data->tokenable_id)->update(['verification' => date('Y-m-d H:i:s')]);
                return redirect('admin/login')->with(['success' => 'Your account is verified']);
            }
        }

        return redirect('admin/login');
    }

}
