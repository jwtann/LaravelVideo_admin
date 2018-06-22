<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminLogin
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

        if (!Auth::user()){
            session()->flash('danger','请先登录后再进行后台操作');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
