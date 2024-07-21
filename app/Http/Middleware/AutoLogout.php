<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AutoLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, int $timeout = 600): mixed
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $lastActivity = Session::get('lastActivityTime');

        if ($lastActivity != null && time() - $lastActivity > $timeout) {
            Auth::logout();
            Session::flush();

            return redirect()->route('logout');
        }

        Session::put('lastActivityTime', time());
        return $next($request);
    }
}
