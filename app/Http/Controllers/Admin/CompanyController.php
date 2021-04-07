<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Admin - Master Company',
            'content' => 'admin.master.company'
        ];

        return view('admin.layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'image',
            'caption',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Banner::count();
        
        $query_data = Banner::where(function($query) use ($search) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('caption', 'like', "%$search%");
                    });
                }            
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Banner::where(function($query) use ($search) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('caption', 'like', "%$search%");
                    });
                }            
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                if($val->image && Storage::exists($val->image)) {
                    $image = '<a href="' . asset(Storage::url($val->image)) . '" data-lightbox="' . $val->caption . '" data-title="' . $val->caption . '"><img src="' . asset(Storage::url($val->image)) . '" style="max-width:100px;"></a>';     
                } else {
                    $image = '<a href="' . asset('website/user.png') . '" data-lightbox="' . $val->caption . '" data-title="' . $val->caption . '"><img src="' . asset('website/user.png') . '" style="max-width:100px;"></a>';
                }

                $caption = '<span data-toggle="tooltip" data-placement="top" title="' . $val->caption . '">' . Str::limit($val->caption, 30) . '</span>';

                $response['data'][] = [
                    $nomor,
                    $image,
                    $caption,
                    $val->status(),
                    '
                        <button type="button" class="btn btn-warning btn-sm" onclick="show(' . $val->id . ')"><i class="fas fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="destroy(' . $val->id . ')"><i class="fas fa-trash"></i> Hapus</button>
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

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image'   => 'required|max:1024|mimes:jpeg,jpg,png|dimensions:min_width:1920,min_height:450',
            'caption' => 'required',
            'status'  => 'required'
        ], [
            'caption.required' => 'Mohon mengisi caption.',
            'image.required'   => 'Mohon mengisi gambar.',
            'image.max'        => 'Gambar maksimal 1MB.',
            'image.max'        => 'Gambar hanya boleh jpeg, jpg, png.',
            'image.dimensions' => 'Dimensi gambar minimal 1920x450',
            'status.required'  => 'Mohon memilih status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $image   = $request->file('image')->store('public/banner');
            $convert = Image::make(storage_path('app/' . $image))
                ->resize(1920, 450)
                ->save();

            $query = Banner::create([
                'image'   => $image,
                'caption' => $request->caption,
                'status'  => $request->status
            ]);

            if($query) {
                activity()
                    ->performedOn(new Banner())
                    ->causedBy(session('id'))
                    ->withProperties($query)
                    ->log('Menambah data master banner');

                $response = [
                    'status'  => 200,
                    'message' => 'Data telah diproses.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data gagal diproses.'
                ];
            }
        }

        return response()->json($response);
    }

    public function show(Request $request)
    {
        $data = Banner::find($request->id);
        return response()->json([
            'image'   => asset(Storage::url($data->image)),
            'caption' => $data->caption,
            'status'  => $data->status
        ]);
    }

    public function update(Request $request, $id)
    {
        $data       = Banner::find($id);
        $validation = Validator::make($request->all(), [
            'image'   => 'max:1024|mimes:jpeg,jpg,png|dimensions:min_width:1920,min_height:450',
            'caption' => 'required',
            'status'  => 'required'
        ], [
            'caption.required' => 'Mohon mengisi caption.',
            'image.max'        => 'Gambar maksimal 1MB.',
            'image.max'        => 'Gambar hanya boleh jpeg, jpg, png.',
            'image.dimensions' => 'Dimensi gambar minimal 1920x450',
            'status.required'  => 'Mohon memilih status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            if($request->has('image')) {
                if($data->image && Storage::exists($data->image)) {
                    Storage::delete($data->image);
                }

                $image   = $request->file('image')->store('public/banner');
                $convert = Image::make(storage_path('app/' . $image))
                    ->resize(1920, 450)
                    ->save();
            } else {
                $image = $data->image;
            }

            $query = Banner::where('id', $id)->update([
                'image'   => $image,
                'caption' => $request->caption,
                'status'  => $request->status
            ]);

            if($query) {
                activity()
                    ->performedOn(new Banner())
                    ->causedBy(session('id'))
                    ->log('Mengubah data master banner');

                $response = [
                    'status'  => 200,
                    'message' => 'Data telah diproses.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data gagal diproses.'
                ];
            }
        }

        return response()->json($response);
    }

    public function destroy(Request $request) 
    {
        $data  = Banner::find($id);
        $query = Banner::where('id', $request->id)->delete();
        if($query) {
            if($data->image && Storage::exists($data->image)) {
                Storage::delete($data->image);
            }

            activity()
                ->performedOn(new Banner())
                ->causedBy(session('id'))
                ->log('Menghapus data master banner');

            $response = [
                'status'  => 200,
                'message' => 'Data telah dihapus.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Data gagal dihapus.'
            ];
        }

        return response()->json($response);
    }

}
