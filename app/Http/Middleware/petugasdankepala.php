<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class petugasdankepala
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $user = Auth::user();

        if (!Auth::check() || ($user->role !== "petugas" && $user->role !== "kepala_perpustakaan")) {
            abort(403);
        }
        return $next($request);
    }
}
