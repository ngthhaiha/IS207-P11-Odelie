<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Configuration\Middleware;
class checkUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == '0') {
            return $next($request); // Cho phép người dùng tiếp tục nếu vai trò là user
        }

        return redirect()->route('getLogin')->with('error', 'Bạn không có quyền truy cập! user');
    }
}
