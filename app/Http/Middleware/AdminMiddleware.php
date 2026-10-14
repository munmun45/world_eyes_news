<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please log in to access the admin panel.');
        }

        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'editor') {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Access denied. Administrator privileges required.');
        }

        return $next($request);
    }
}
