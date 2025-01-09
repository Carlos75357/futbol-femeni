<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // dd('Rol: ' . $role . ' Rol del usuario: ' . auth()->user()->role);
        if ($request->is('partits/*') && !$role === 'arbitre' || $this->isPartitModificationRoute($request) && !$role === 'arbitre') {
            return redirect('/partits');
        }
        if (!auth()->check() || auth()->user()->role !== $role) {
            return redirect('/login');
        }
        return $next($request);
    }
    
    
    /**
     * Check if the route is a modification route for partit.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function isPartitModificationRoute(Request $request): bool
    {
        return $request->is('partits/*/edit') || $request->is('partits/*/delete');
    }
}
