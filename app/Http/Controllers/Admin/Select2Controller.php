<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
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

}
