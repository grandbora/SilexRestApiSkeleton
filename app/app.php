<?php

use CODEAlchemy\Wisdom\Silex\Provider;

$baseDir = dirname(__DIR__);
require_once $baseDir . '/app/bootstrap.php';

$app = new Silex\Application();

if ("prod" !== getenv("APPLICATION_ENV")) {
    //todo : move to somewhere else 
    $app['debug'] = true;
}

$app->register(new Provider, array(
    'wisdom.path' => $baseDir . '/config',
    'wisdom.options' => array(
        'prefix' => getenv("APPLICATION_ENV").'.'
    )
));

$app->mount('/users', new \Provider\UserControllerProvider());

return $app;