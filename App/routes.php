<?php

use App\Middlewares\JwtAuth;
use Slim\App;
use Src\controllers\ForgotPasswordController;
use Src\controllers\SessionController;
use Src\controllers\UserController;

use function DI\add;

return function (App $app) {
    $app->get('/users', UserController::class . ':index');

    $app->get('/users/{id}', UserController::class . ':show');

    $app->put('/users/{id}', UserController::class . ':update')
        ->add(new JwtAuth())
        ->add($app->getContainer()->get('jwt'));


    $app->post('/users', UserController::class . ':store');

    $app->post('/sessions', SessionController::class . ':store');
    $app->post('/forgotPassword/{refreshtoken}', ForgotPasswordController::class . ':store');
};
