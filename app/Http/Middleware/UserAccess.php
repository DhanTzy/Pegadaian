<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        // dd(auth()->user()->type);
        if (auth()->user()->type == $userType) {
            return $next($request);
        }

        // Jika tipe pengguna tidak sesuai, kembalikan halaman 403 (Forbidden)
        return abort(403, 'Kamu tidak memiliki akses halaman ini Mending tidur saja.');
    }
}
