<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class RoleAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permissions = Cache::remember("user_permission_".$request->user()->id, now()->addHours(2), function () use ($request) {
            return $request->user()->permissions();
        });

        $request->attributes->add(['user_permissions' => $permissions]);/*  global available in all controller under request */
        View::share('user_permissions', $permissions);
        return $next($request);
    }
}
