<?php

use App\controllers\UserController;

use Slim\App;

return function (App $app) {
    $app->get('/users', UserController::class . ':index');

    $app->get('/users/{id}', UserController::class . ':show');
};
