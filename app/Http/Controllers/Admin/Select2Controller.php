<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Select2Controller extends Controller {
    
    public function type(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Type::select('id', 'code')
            ->where('code', 'like', "%$search%")
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->code
            ];
        }

        return response()->json(['items' => $response]);
    }

    public function product(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Product::where(function($query) use ($search) {
                $query->whereHas('type', function($query) use ($search) {
                        $query->whereRaw('INSTR(?, code)', [$search])
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhereHas('division', function($query) use ($search) {
                                $query->whereRaw('INSTR(?, code)', [$search])
                                    ->orWhere('code', 'like', "%$search%")
                                    ->orWhere('name', 'like', "%$search%");
                            });
                    })
                    ->orWhereHas('brand', function($query) use ($search) {
                        $query->whereRaw('INSTR(?, code)', [$search])
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    })
                    ->orWhereHas('country', function($query) use ($search) {
                        $query->whereRaw('INSTR(?, code)', [$search])
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    })
                    ->orWhereHas('grade', function($query) use ($search) {
                        $query->whereRaw('INSTR(?, code)', [$search])
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    });
            })
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->code()
            ];
        }

        return response()->json(['items' => $response]);
    }

}
