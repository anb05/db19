<?php

namespace Db19\Http\Middleware;

use Closure;

class CheckEntranceDb
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
            \Config::set('database.connections.mysql_input_doc.username', session('login_db'));
            \Config::set('database.connections.mysql_input_doc.password', session('password_db'));

            return $next($request);
        }
        return redirect('/entrance');
    }
}
