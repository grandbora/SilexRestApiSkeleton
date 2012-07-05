<?php

use CODEAlchemy\Wisdom\Silex\Provider;
use Silex\Provider\MonologServiceProvider;
use Provider\Controller\UtilControllerProvider;
use Provider\Controller\UserControllerProvider;
use Silex\Provider\DoctrineServiceProvider;

$baseDir = dirname(__DIR__);
require_once $baseDir . '/app/bootstrap.php';

$app = new Silex\Application();

if ("dev" === getenv("APPLICATION_ENV")) {
    //todo : move to somewhere else  
    $app['debug'] = true;
    ini_set('error_reporting', -1);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

$app->register(new Provider, array(
    'wisdom.path' => $baseDir . '/config',
    'wisdom.options' => array(
        'prefix' => getenv("APPLICATION_ENV") . '.'
    )
));
$config = $app['wisdom']->get('config.json');

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => $config['log']['path'],
    'monolog.level' => constant('Monolog\Logger::' . $config['log']['level']),
    'monolog.name' => 'silex-rest-api'
));

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => $config['db']['driver'],
        'dbname' => $config['db']['dbname'],
        'host' =>  $config['db']['host'],
        'user' =>  $config['db']['user'],
        'password' =>  $config['db']['password']
    ),
));

$app->mount('', new UtilControllerProvider());
$app->mount('/users', new UserControllerProvider());

return $app;