<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName();
        /*$permissions       =    $request->user()->permissions();*/

        $permissions = Cache::remember("user_permission_".$request->user()->id, now()->addHours(2), function () use ($request) {
            return $request->user()->permissions();
        });

        $request->attributes->add(['user_permissions' => $permissions]);/*  global available in all controller under request */
        View::share('user_permissions', $permissions);

        if ($request->ajax()) {
            if (isAccessible($routeName)) {
                return $next($request);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not allowed to access the current Url'
                ], 403);
            }
        }

        if (isAccessible($routeName)) {
            return $next($request);
        }
        return abort('403');
    }
}
