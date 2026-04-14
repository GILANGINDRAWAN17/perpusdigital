<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // Middleware untuk membatasi akses halaman berdasarkan role user
    public function handle($request, Closure $next, ...$roles)
    {
        // Belum login
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $user = Auth::user();

        // Role tidak sesuai
        if (!in_array($user->role, $roles, true)) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}