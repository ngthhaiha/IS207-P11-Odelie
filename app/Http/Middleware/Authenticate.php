<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('getLogin')->with('error', 'Bạn cần đăng nhập để tiếp tục!');
        }

        // Allow request to proceed if authenticated
        return $next($request);
    }
}
