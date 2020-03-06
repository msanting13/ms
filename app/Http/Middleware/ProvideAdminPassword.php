<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hash;

class ProvideAdminPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json(['error' => false, 'message' => 'incorrect password']);
        }else{
            return $next($request);
        }
    }
}
