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
                        $query->where('code', 'like', "%$search%");
                    })
                    ->orWhereHas('company', function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%");
                    })
                    ->orWhereHas('brand', function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%");
                    })
                    ->orWhereHas('country', function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%");
                    })
                    ->orWhereHas('grade', function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%");
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
