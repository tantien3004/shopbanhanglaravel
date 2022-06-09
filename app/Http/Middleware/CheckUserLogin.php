<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
{
    public function handle(Request $request, Closure $next)
    {
            if(Auth::check())
            {
                if(Auth::user()->id != null)
                {
                    return $next($request);
                } else if (Auth::user()->id == null)
                {
                    return redirect()->route('user.login');
                }
                return redirect()->route('user.login')->with('error', 'Vui lòng đăng kí!');
            }
            return redirect()->route('user.login')->with('error', 'Vui lòng đăng nhập trước!');
    }
}
