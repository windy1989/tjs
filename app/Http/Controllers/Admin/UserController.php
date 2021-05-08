<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Token;
use App\Models\UserRole;
use App\Jobs\EmailProcess;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Setting User',
            'content' => 'admin.setting.user'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'detail',
            'id',
            'photo',
            'name',
            'branch',
            'verification',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = User::count();
        
        $query_data = User::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }         
                
                if($request->status) {
                    $query->where('status', $request->status);
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = User::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
                }       
                
                if($request->status) {
                    $query->where('status', $request->status);
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                if(Storage::exists($val->photo)) {
                    $photo = '<a href="' . asset(Storage::url($val->photo)) . '" data-lightbox="' . $val->name . '" data-title="' . $val->name . '"><img src="' . asset(Storage::url($val->photo)) . '" style="max-width:70px;" class="img-fluid img-thumbnail"></a>';
                } else {
                    $photo = '<a href="' . asset('website/user.png') . '" data-lightbox="' . $val->name . '" data-title="' . $val->name . '"><img src="' . asset('website/user.png') . '" style="max-width:70px;" class="img-fluid img-thumbnail"></a>';
                }

                $response['data'][] = [
                    '<span class="pointer-element badge badge-success" data-id="' . $val->id . '"><i class="icon-plus3"></i></span>',
                    $nomor,
                    $photo,
                    $val->name,
                    $val->branch(),
                    $val->verification ? date('d F Y', strtotime($val->verification)) : 'Not Verified',
                    $val->status(),
                    '
                        <button type="button" class="btn bg-success btn-sm" data-popup="tooltip" title="Reset Password" onclick="resetPassword(' . $val->id . ')"><i class="icon-lock"></i></button>
                        <button type="button" class="btn bg-warning btn-sm" data-popup="tooltip" title="Edit" onclick="show(' . $val->id . ')"><i class="icon-pencil7"></i></button>
                        <button type="button" class="btn bg-danger btn-sm" data-popup="tooltip" title="Delete" onclick="destroy(' . $val->id . ')"><i class="icon-trash-alt"></i></button>
                    '
                ];

                $nomor++;
            }
        }

        $response['recordsTotal'] = 0;
        if($total_data <> FALSE) {
            $response['recordsTotal'] = $total_data;
        }

        $response['recordsFiltered'] = 0;
        if($total_filtered <> FALSE) {
            $response['recordsFiltered'] = $total_filtered;
        }

        return response()->json($response);
    }

    public function rowDetail(Request $request)
    {
        $data = User::find($request->id);
        $role = [];

        foreach($data->userRole as $ur) {
            $role[] = $ur->role();
        }
        return response()->json([
            'email' => $data->email,
            'role'  => $role
        ]);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'photo'     => 'image|max:200|mimes:jpg,jpeg,png',
            'name'      => 'required',
            'email'     => 'required|unique:users,email',
            'password'  => 'required',
            'branch'    => 'required',
            'role'      => 'required|array',
            'status'    => 'required'
        ], [
            'photo.image'        => 'Photo must be image.',
            'photo.max'          => 'Photo max 200KB.',
            'photo.mimes'        => 'Photo extension must be jpg, jpeg, png.',
            'name.required'      => 'Name cannot be empty.',
            'email.required'     => 'Email cannot be empty.',
            'email.unique'       => 'Email already exists.',
            'password.required'  => 'Password cannot be empty.',
            'branch.required'    => 'Please select a branch.',
            'role.required'      => 'Please select a role.',
            'role.array'         => 'Role must be array.',
            'status.required'    => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            if($request->has('photo')) {
                $photo = $request->file('photo')->store('public/user');
            } else {
                $photo = null;
            }

            $query = User::create([
                'photo'    => $photo,
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
                'branch'   => $request->branch,
                'status'   => $request->status
            ]);

            if($query) {
                foreach($request->role as $ur) {
                    UserRole::create([
                        'user_id' => $query->id,
                        'role'    => $ur
                    ]);
                }

                activity()
                    ->performedOn(new User())
                    ->causedBy(session('bo_id'))
                    ->withProperties($query)
                    ->log('Add setting user data');

                $token = Token::create([
                    'tokenable_type' => 'users',
                    'tokenable_id'   => $query->id,
                    'token'          => Str::random(45),
                    'type'           => 1,
                    'valid'          => date('Y-m-d H:i:s', strtotime('+1 day')),
                    'status'         => 1
                ]);

                $payload = [
                    'name'    => $query->name,
                    'email'   => $query->email,
                    'link'    => url('admin/verification?token=' . base64_encode($token->token)),
                    'view'    => 'verification',
                    'subject' => 'SMB Admin | Verification Account'
                ];

                dispatch(new EmailProcess($payload));
                $response = [
                    'status'  => 200,
                    'message' => 'Data added successfully.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data failed to add.'
                ];
            }
        }

        return response()->json($response);
    }

    public function show(Request $request)
    {
        $data = User::find($request->id);
        $role = [];

        foreach($data->userRole as $ur) {
            $role[] = $ur->role;
        }

        return response()->json([
            'photo'     => $data->photo ? asset(Storage::url($data->photo)) : asset('website/user.png'),
            'name'      => $data->name,
            'email'     => $data->email,
            'password'  => $data->password,
            'branch'    => $data->branch,
            'status'    => $data->status,
            'role'      => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        $user       = User::find($id);
        $validation = Validator::make($request->all(), [
            'photo'     => 'image|max:200|mimes:jpg,jpeg,png',
            'name'      => 'required',
            'email'     => ['required', Rule::unique('users', 'email')->ignore($id)],
            'branch'    => 'required',
            'role'      => 'required|array',
            'status'    => 'required'
        ], [
            'photo.image'        => 'Photo must be image.',
            'photo.max'          => 'Photo max 200KB.',
            'photo.mimes'        => 'Photo extension must be jpg, jpeg, png.',
            'name.required'      => 'Name cannot be empty.',
            'email.required'     => 'Email cannot be empty.',
            'email.unique'       => 'Email already exists.',
            'branch.required'    => 'Please select a branch.',
            'role.required'      => 'Please select a role.',
            'role.array'         => 'Role must be array.',
            'status.required'    => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            if($request->has('photo')) {
                if(Storage::exists($user->photo)) {
                    Storage::delete($user->photo);
                }

                $photo = $request->file('photo')->store('public/user');
            } else {
                $photo = $user->photo;
            }

            $user->update([
                'photo'    => $photo,
                'name'     => $request->name,
                'email'    => $request->email,
                'branch'   => $request->branch,
                'status'   => $request->status
            ]);

            if($user) {
                UserRole::where('user_id', $id)->delete();
                foreach($request->role as $ur) {
                    UserRole::create([
                        'user_id' => $id,
                        'role'    => $ur
                    ]);
                }

                activity()
                    ->performedOn(new User())
                    ->causedBy(session('bo_id'))
                    ->log('Change the user setting data');

                $response = [
                    'status'  => 200,
                    'message' => 'Data updated successfully.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data failed to update.'
                ];
            }
        }

        return response()->json($response);
    }

    public function destroy(Request $request) 
    {
        $query = User::where('id', $request->id)->delete();
        if($query) {
            activity()
                ->performedOn(new User())
                ->causedBy(session('bo_id'))
                ->log('Delete the user setting data');

            $response = [
                'status'  => 200,
                'message' => 'Data deleted successfully.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Data failed to delete.'
            ];
        }

        return response()->json($response);
    }

    public function resetPassword(Request $request) 
    {
        $query = User::where('id', $request->id)->update(['password' => bcrypt('smartmarble')]);
        if($query) {
            activity()
                ->performedOn(new User())
                ->causedBy(session('bo_id'))
                ->log('Reset password user setting data');

            $response = [
                'status'  => 200,
                'message' => 'Password successfully reset.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Password failed to reset.'
            ];
        }

        return response()->json($response);
    }

}
