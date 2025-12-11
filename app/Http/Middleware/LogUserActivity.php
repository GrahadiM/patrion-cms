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
        // Skip logging untuk beberapa route
        $skipRoutes = [
            'livewire.*',
            'filament.*',
            'horizon.*',
            'telescope.*',
            'debugbar.*',
            'activity-logs.*' // Skip logging untuk activity logs sendiri
        ];

        foreach ($skipRoutes as $route) {
            if ($request->routeIs($route)) {
                return $next($request);
            }
        }

        if (Auth::check()) {
            $user = Auth::user();
            $routeName = $request->route()->getName();
            $method = $request->method();
            $path = $request->path();
            $ip = $request->ip();
            $userAgent = $request->header('User-Agent');

            // Tentukan log name berdasarkan route
            $logName = 'default';
            if (str_contains($routeName, 'characters')) {
                $logName = 'characters';
            } elseif (str_contains($routeName, 'programs')) {
                $logName = 'programs';
            } elseif (str_contains($routeName, 'users')) {
                $logName = 'users';
            } elseif (str_contains($routeName, 'profile')) {
                $logName = 'profile';
            }

            // Log activity
            activity()
                ->causedBy($user)
                ->withProperties([
                    'route' => $routeName,
                    'method' => $method,
                    'path' => $path,
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'url' => $request->fullUrl(),
                    'referer' => $request->header('referer'),
                ])
                ->useLog($logName)
                ->log('User visited ' . $path);
        }

        return $next($request);
    }
}
