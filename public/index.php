<?php

use DI\Container;
use Selective\BasePath\BasePathDetector;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container;

$settings = require __DIR__ . '/../App/settings.php';

$settings($container);

AppFactory::setContainer($container);

$app = AppFactory::create();
$basePath = (new BasePathDetector($_SERVER))->getBasePath();
$app->setBasePath($basePath);

$middleware = require __DIR__ . '/../App/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/../App/routes.php';
$routes($app);

$app->run();
