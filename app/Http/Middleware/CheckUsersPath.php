<?php

namespace Db19\Http\Middleware;

use Closure;

class CheckUsersPath
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
        $pathExplode = explode('/', $request->path());
        if ($pathExplode[0] != \Auth::user()->role_name) {
            abort(404);
        }
        return $next($request);
    }
}
