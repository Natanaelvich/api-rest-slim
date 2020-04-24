<?php

namespace App\Middlewares;

use Tuupola\Middleware\JwtAuthentication;

class JWTsettings
{
    public  function jwtSettings(): JwtAuthentication
    {
        return new JwtAuthentication([
            'secret' => sha1('natanael'),
            'attribute' => 'jwt'
        ]);
    }
}
