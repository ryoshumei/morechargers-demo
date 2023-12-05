<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || !$request->user()->hasRole($role)) {
            // if user is not authenticated or does not have role
            abort(403, 'Access denied');
        }
        // if user is authenticated and has role
        // continue with request
        return $next($request);
    }
}
