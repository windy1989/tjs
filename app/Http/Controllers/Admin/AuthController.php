<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Token;
use App\Jobs\EmailProcess;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        session()->flush();
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

    public function forgotPassword(Request $request)
    {
        $account = User::where('email', $request->email)->whereNotNull('verification')->first();
        if($account) {
            Token::where('tokenable_type', 'users')
                ->where('tokenable_id', $account->id)
                ->where('type', 2)
                ->update(['status' => 2]);

            $token = Token::create([
                'tokenable_type' => 'users',
                'tokenable_id'   => $account->id,
                'token'          => Str::random(45),
                'type'           => 2,
                'valid'          => date('Y-m-d H:i:s', strtotime('+1 day')),
                'status'         => 1
            ]);

            $payload = [
                'name'    => $account->name,
                'email'   => $account->email,
                'link'    => url('admin/reset_password?token=' . base64_encode($token->token)),
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
            ->where('tokenable_type', 'users')
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
                    $query = User::find($customer->tokenable_id)->update([
                        'password' => bcrypt($request->password)
                    ]);

                    return redirect('admin/login')->with(['success' => 'Password successfully reset']);
                }
            } else {
                return view('admin.auth.reset_password');
            }
        }

        return redirect('admin/login');
    }

    public function profile(Request $request)
    {
        $query = User::find(session('bo_id'));
        if($request->has('_token') && session()->token() == $request->_token) {
            $validation = Validator::make($request->all(), [
                'photo' => 'image|max:200|mimes:jpg,jpeg,png',
                'name'  => 'required',
                'email' => ['required', Rule::unique('users', 'email')->ignore($query->id)]
            ], [
                'photo.image'    => 'Photo must be image.',
                'photo.max'      => 'Photo max 200KB.',
                'photo.mimes'    => 'Photo extension must be jpg, jpeg, png.',
                'name.required'  => 'Name cannot be empty.',
                'email.required' => 'Email cannot be empty.',
                'email.unique'   => 'Email already exists.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                if($request->has('photo')) {
                    if(Storage::exists($query->photo)) {
                        Storage::delete($query->photo);
                    }

                    $photo = $request->file('photo')->store('public/user');
                } else {
                    $photo = $query->photo;
                }

                if($request->change_password) {
                    $validation = Validator::make($request->all(), [
                        'password'         => 'required',
                        'password_confirm' => 'required|same:password'
                    ], [
                        'password.required'         => 'Password cannot be empty',
                        'password_confirm.required' => 'Password confirmation cannot be empty',
                        'password_confirm.same'     => 'Password confirmation not match with password',
                    ]);

                    if($validation->fails()) {
                        return redirect()->back()->withErrors($validation)->withInput();
                    } else {
                        $query->update([
                            'photo'    => $photo,
                            'name'     => $request->name,
                            'email'    => $request->email,
                            'password' => bcrypt($request->password)
                        ]);
                    }
                } else {
                    $query->update([
                        'photo' => $photo,
                        'name'  => $request->name,
                        'email' => $request->email
                    ]);
                }

                activity()
                    ->performedOn(new User())
                    ->causedBy(session('bo_id'))
                    ->log('Change profile');

                return redirect()->back()->with(['success' => 'Data successfully changed.']);
            }
        } else {
            $data = [
                'title'   => 'Profile',
                'user'    => $query,
                'content' => 'admin.auth.profile'
            ];

            return view('admin.layouts.index', ['data' => $data]);
        }
    }

    public function myActivity(Request $request)
    {
        $activity = ActivityLog::where('causer_id', session('bo_id'))
            ->where(function($query) use ($request) {
                if($request->start_date && $request->finish_date) {
                    $query->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->finish_date);
                } else if($request->start_date) {
                    $query->whereDate('created_at', $request->start_date);
                } else if($request->finish_date) {
                    $query->whereDate('created_at', $request->finish_date);
                }
            })
            ->latest()
            ->paginate(10);

        $data = [
            'title'       => 'My Activity',
            'activity'    => $activity,
            'start_date'  => $request->start_date,
            'finish_date' => $request->finish_date,
            'content'     => 'admin.auth.my_activity'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function logout()
    {
        session()->flush();
        return redirect('admin/login')->with(['success' => 'You successfully logout.']);
    }

}
