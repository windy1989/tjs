<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebHookController extends Controller {
    
    public function xendit(Request $request)
    {
        return response()->json($request->all());
    }

}
