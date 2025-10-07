<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('admin_id')) {
            return Redirect::to('/admin')->with('message', 'Vui lòng đăng nhập trước');
        }

        return $next($request);
    }
}
