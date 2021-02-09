<?php

namespace Archinet\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsActive
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
        $user = Auth::user();

        if(Auth::check() && Auth::user()->estado != 'activo'){
            Auth::logout();

            return redirect('/')
                ->withErrors(['email'=>trans('auth.user_inactive')])
                ->withInput(['email'=>$user->email]);
        }

        return $next($request);
    }
}
