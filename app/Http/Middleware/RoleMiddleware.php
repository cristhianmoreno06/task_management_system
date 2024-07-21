<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function handle(Request $request, Closure $next, $role): Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
    {
        if (auth()->check() && auth()->user()->hasRole($role)) {
            return $next($request);
        }

        return view('error.404'); // O una página de acceso denegado
    }
}
