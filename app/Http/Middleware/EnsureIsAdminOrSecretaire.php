<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdminOrSecretaire
{
    public function handle(Request $request, Closure $next): Response
    {
        $role = strtolower(auth()->user()->role ?? '');

        if (!in_array($role, ['admin', 'secretaire'])) {
            abort(403, 'Action réservée aux Administrateurs et Secrétaires.');
        }

        return $next($request);
    }
}