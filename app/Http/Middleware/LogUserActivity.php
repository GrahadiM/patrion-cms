<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $routeName = $request->route()->getName();
            $method = $request->method();
            $path = $request->path();
            $ip = $request->ip();

            activity()
                ->causedBy($user)
                ->withProperties([
                    'route' => $routeName,
                    'method' => $method,
                    'path' => $path,
                    'ip' => $ip,
                    'user_agent' => $request->header('User-Agent'),
                ])
                ->log('User activity');
        }

        return $next($request);
    }
}
