<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $roles = ['Admin','Employee','Technician'];

        // $userRoles = Auth::user()->roles;
        // dd($userRoles);
        if(Auth::user()->hasAnyRole($roles)){
            return $next($request);
        }
        return redirect()->back();
    }
}
