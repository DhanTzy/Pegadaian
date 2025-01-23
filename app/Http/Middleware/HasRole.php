<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // dd(auth()->user()->role);
        $user = auth()->user();
        if ($user && (is_array($role) ? in_array($user->role, $role) : $user->role == $role)) {
            return $next($request);
        }

        return abort(403, 'Kamu tidak memiliki akses halaman ini. Mending tidur saja. Besok Libur :)');
    }
}
