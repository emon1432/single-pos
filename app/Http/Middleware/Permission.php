<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role_id == 1) {
            return $next($request);
        }
        $routeName = $request->route()->getName();
        if (!check_permission($routeName)) {
            notify()->error('You do not have permission to access this page');
            return redirect()->back();
        }
        return $next($request);
    }
}
