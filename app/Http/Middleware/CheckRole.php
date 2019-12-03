<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        $actions = $request->route()->getAction();
        $roles = isset($actions['role']) ? $actions['role'] : null;
        if ($request->user()->hasAnyRole($roles) || !$roles) 
        {
            return $next($request);
        }
        return abort(401, 'This action is unauthorized.');
        //return $next($request);
    }
}
