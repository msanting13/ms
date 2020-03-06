<?php

namespace App\Http\Middleware;

use Closure;
use App\Card;

class CheckifLocked
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
        $status = Card::find($request->route('id'));

        if ($status->is_lock) {
            return abort(401, 'This action is unauthorized.');
        }else{
            return $next($request);
        }
        //dd($card);
        // $actions = $request->route()->getAction();
        // dd($request->route()->getAction());
        // return $next($request);
    }
}
