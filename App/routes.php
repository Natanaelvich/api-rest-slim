<?php


use Slim\App;
use Src\controllers\SessionController;
use Src\controllers\UserController;

return function (App $app) {
    $app->get('/users', UserController::class . ':index');

    $app->get('/users/{id}', UserController::class . ':show');

    $app->post('/users', UserController::class . ':store');

    $app->post('/sessions', SessionController::class . ':store');
};
