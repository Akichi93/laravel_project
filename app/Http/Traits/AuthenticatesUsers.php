<?php

namespace App\Http\Traits;

use Tymon\JWTAuth\Facades\JWTAuth;

trait AuthenticatesUsers
{
    /**
     * Récupérer l'utilisateur authentifié.
     *
     * @return \App\Models\User|null
     */
    protected function getAuthenticatedUser()
    {
        return JWTAuth::parseToken()->authenticate();
    }
}


