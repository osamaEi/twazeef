<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403, 'Access denied. Admin role required.');
        }

        if ($role === 'company' && !$user->isCompany()) {
            abort(403, 'Access denied. Company role required.');
        }

        if ($role === 'employee' && !$user->isEmployee()) {
            abort(403, 'Access denied. Employee role required.');
        }

        return $next($request);
    }
}
