<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LogAktivitas;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Log hanya untuk user yang sudah login dan method POST/PUT/DELETE
        if (auth()->check() && in_array($request->method(), ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            $route = $request->route();
            $routeName = $route ? $route->getName() : 'unknown';
            
            // Skip logging untuk route tertentu
            $skipRoutes = ['logout', 'csrf-token'];
            if (!in_array($routeName, $skipRoutes)) {
                LogAktivitas::log(
                    strtoupper($request->method()),
                    $routeName ?: $request->path(),
                    $request->except(['password', 'password_confirmation', '_token'])
                );
            }
        }

        return $response;
    }
}