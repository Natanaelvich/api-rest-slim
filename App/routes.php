<?php


use Slim\App;
use Src\controllers\UserController;

return function (App $app) {
    $app->get('/users', UserController::class . ':index');

    $app->get('/users/{id}', UserController::class . ':show');

    $app->post('/users', UserController::class . ':store');
};
