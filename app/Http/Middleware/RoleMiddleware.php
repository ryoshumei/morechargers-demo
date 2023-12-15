<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 检查用户是否认证且拥有其中一个角色
        if (!Auth::check() || !$this->checkUserHasAnyRole($request->user(), $roles)) {
            // 日志记录
            Log::info('CheckRole Middleware - User Role: ', ['role' => $request->user()->user_role]);
            Log::info('CheckRole Middleware - Passed', ['url' => $request->url()]);
            // 用户未认证或不拥有角色
            abort(403, 'Access denied');
        }
        // 用户认证且拥有角色，继续请求
        return $next($request);
    }
    private function checkUserHasAnyRole($user, $roles)
    {
        foreach ($roles as $role) {
            Log::info('CheckRole Middleware - Checking role: ', ['role' => $role]);
            Log::info('CheckRole Middleware - User has role: ', ['hasRole' => $user->hasRole($role)]);
            if ($user->hasRole($role)) {
                return true;
            }
        }
        return false;
    }
}
