<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserAllowed
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
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized.');
        }

        if (!$request->has('email')) {
            $request->merge(['email' => $user->email]);
        }

        if (!$user->isAdmin() && $request->input('email') !== $user->email) {
            abort(403, 'Unauthorized action.');
        }

        // if (!$user || (!$user->isAdmin() && (!$user || $request->input('email') !== $user->email))) {
        //     abort(403);
        // }

        return $next($request);
    }
}
