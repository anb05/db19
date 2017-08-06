<?php

namespace Db19\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfEntranceDb
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
        if($request->session()->has('login_db') && $request->session()->has('password_db')) {
            $group = Auth::user()->group_name;

            return redirect('/' . $group);
        }
        return $next($request);
    }
}
