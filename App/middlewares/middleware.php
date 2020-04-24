<?php

namespace App\Middlewares;

use Slim\App;

return function (App $app) {
    $setting = $app->getContainer()->get('settings');

    $app->addErrorMiddleware(
        $setting['displayErrorDetails'],
        $setting['logErrorDetails'],
        $setting['logErros']
    );

    $app->addBodyParsingMiddleware();
};
