<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'staff')) {
            return $next($request);
        }
        return redirect()->back()->with('error', 'You are not authorized to access this page.');
    }
}
