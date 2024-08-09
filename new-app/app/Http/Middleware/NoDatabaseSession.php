<?php

namespace App\Http\Middleware;

use Closure;

class NoDatabaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Temporarily change database connection to SQLite or another non-MySQL database
        config(['database.default' => 'sqlite']);
        
        return $next($request);
    }
}
