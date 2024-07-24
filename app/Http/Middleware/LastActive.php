<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LastActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && (now()->diffInMinutes(auth()->user()->last_active_at) >= 5 || auth()->user()->last_active_at == null)) {
            auth()->user()->update(['last_active_at' => now()]);
        }

        return $next($request);
    }
}
