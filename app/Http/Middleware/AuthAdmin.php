<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->user_type !== 'Admin') {
            return redirect()->route('login')->with('error_message', 'Access denied.');
        }

        return $next($request);
    }
}