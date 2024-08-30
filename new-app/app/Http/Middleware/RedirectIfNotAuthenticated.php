<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Gérer une requête entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Redirige les utilisateurs non authentifiés vers la page d'accueil
        if (!Auth::check()) {
            return redirect()->route('Acceuil');
        }

        return $next($request);
    }
}
