<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoutes = ['/', '/current_collections', '/done_collections'];

        if (in_array($request->path(), $allowedRoutes) && Auth::check()) {
            return redirect('/dashboard'); // Если пользователь аутентифицирован, перенаправьте его на другую страницу
        }

        return $next($request);
    }
}
