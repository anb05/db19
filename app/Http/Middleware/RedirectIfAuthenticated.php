<?php

namespace Db19\Http\Middleware;

use Db19\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            $user = Auth::user()->id;
            $group = User::find($user)->group->name;

            return redirect('/' . $group);
        }

        return $next($request);
    }
}
