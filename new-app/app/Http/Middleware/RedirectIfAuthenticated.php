<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Les routes auxquelles les utilisateurs authentifiés ne peuvent pas accéder.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Manipule une requête entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/login'); // Redirige les utilisateurs authentifiés
        }

        return $next($request);
    }
}
