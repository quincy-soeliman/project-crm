<?php

namespace App\Http\Middleware;

use Closure;
use Request;

class UserCanOnlyEditHisOwnProfile
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
        if (Request::has('user') && Request::get('user') !== Auth::id()) {
            return redirect('profile/' . $user_id);
        }

        return $next($request);
    }
}
