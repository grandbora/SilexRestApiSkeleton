<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/asd', function() use($app) {
            echo "asd";
        });

$app->get('/', function() use($app) {
            echo "ROOT WOOT";
        });

$app->run();