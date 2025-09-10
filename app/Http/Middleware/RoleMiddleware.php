<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // pecah parameter role (bisa admin,dokter)
        $rolesArray = explode(',', $roles);

        // cek apakah role user termasuk dalam daftar
        if (! in_array(auth()->user()->role, $rolesArray)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
