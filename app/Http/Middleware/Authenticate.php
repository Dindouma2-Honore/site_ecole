<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin.login');
    }

    /**
     * Gère la redirection différemment selon le guard demandé
     * (admin -> admin.login, apprenant -> espace-apprenant.login).
     */
    protected function unauthenticated($request, array $guards)
    {
        if (in_array('apprenant', $guards) && !$request->expectsJson()) {
            throw new AuthenticationException(
                'Unauthenticated.', $guards, route('espace-apprenant.login')
            );
        }

        parent::unauthenticated($request, $guards);
    }
}
