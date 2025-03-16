<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->is_admin != true) {
            abort(403);
        } else if (auth()->user()->is_admin === true) {
            redirect('/admin/dashboard');
        }

        // Continue processing the request
        return $next($request);
    }

}
