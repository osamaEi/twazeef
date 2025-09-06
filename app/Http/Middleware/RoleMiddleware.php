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

        // Support for multiple roles (e.g., 'admin,admin_user')
        if (str_contains($role, ',')) {
            $roles = explode(',', $role);
            $hasRole = false;

            foreach ($roles as $r) {
                $r = trim($r);
                if (($r === 'admin' && $user->isAdmin()) ||
                    ($r === 'admin_user' && $user->isAdminUser()) ||
                    ($r === 'admin_company' && $user->isAdminCompany()) ||
                    ($r === 'company' && $user->isCompany()) ||
                    ($r === 'employee' && $user->isEmployee())
                ) {
                    $hasRole = true;
                    break;
                }
            }

            if (!$hasRole) {
                abort(403, 'Access denied. Required role not found.');
            }
        } else {
            // Single role check
            if ($role === 'admin' && !$user->isAdmin()) {
                abort(403, 'Access denied. Admin role required.');
            }

            if ($role === 'admin_user' && !$user->isAdminUser()) {
                abort(403, 'Access denied. Admin User role required.');
            }

            if ($role === 'admin_company' && !$user->isAdminCompany()) {
                abort(403, 'Access denied. Admin Company role required.');
            }

            if ($role === 'company' && !$user->isCompany()) {
                abort(403, 'Access denied. Company role required.');
            }

            if ($role === 'employee' && !$user->isEmployee()) {
                abort(403, 'Access denied. Employee role required.');
            }
        }

        return $next($request);
    }
}
