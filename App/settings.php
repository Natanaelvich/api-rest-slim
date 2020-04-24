<?php

use Tuupola\Middleware\JwtAuthentication;

return function (\DI\Container $container) {
    $container->set('settings', function () {
        return [
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErros' => true,
        ];
    });

    $container->set('jwt', function () {
        return new JwtAuthentication([
            'secret' => sha1('natanaelima'),
            'attribute' => 'jwt'
        ]);
    });
};
