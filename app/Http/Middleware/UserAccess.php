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
        $user = auth()->user();

        if ($user && (is_array($userType) ? in_array($user->type, $userType) : $user->type == $userType)) {
            return $next($request);
        }

        return abort(403, 'Kamu tidak memiliki akses halaman ini. Mending tidur saja.');
    }
}
