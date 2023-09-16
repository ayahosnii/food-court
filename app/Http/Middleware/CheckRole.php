<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
      if (Auth::guard($role)->check() && Auth::guard($role)->user()->hasRole($role)) {
        return $next($request);
      }


        // If the user does not have the required role, you can customize the response here.
        abort(403, 'Unauthorized.');

        // Alternatively, you can redirect the user to a different page:
        // return redirect()->route('home')->with('error', 'You do not have permission to access this page.');

    }
}
