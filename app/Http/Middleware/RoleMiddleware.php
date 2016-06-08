<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Checks if the user is logged in.
        if (!Auth::check()) {
            return redirect('login')->with('status', 'U heeft geen rechten om de pagina te bezoeken.');
        }

        // Checks if the current user's role is equal to $role
        if (Auth::user()->role !== $role) {
            return back()->with('status', 'U heeft geen rechten om de pagina te bezoeken.');
        }

        return $next($request);
    }
}
