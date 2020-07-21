<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class RemoteAuth
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
        if (!empty(session('authUser'))) {
            $user = $request->session()->get('authUser');

            User::createAuth($user);

            return $next($request);
        }

        return redirect('/login');
    }
}
