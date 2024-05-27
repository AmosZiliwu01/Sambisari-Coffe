<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            // Get the user's role
            $userRole = Auth::user()->role;

            // Check if the user's role matches any of the allowed roles
            if (in_array($userRole, $roles)) {
                // User is authorized, allow access to the route
                return $next($request);
            }
        }

        // User is not authorized, redirect back or to a specific route
        return redirect()->route('home.index')->with('pesan', ['error', 'Unauthorized']);
    }
}
