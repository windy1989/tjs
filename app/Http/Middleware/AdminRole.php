<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $idrole)
    {
        $role = session('bo_role');

        #Head of Finance 
        if(in_array($idrole,$role)){
            return $next($request);
        }else{
            abort(401, 'This action is unauthorized.');
        }
    }
}
