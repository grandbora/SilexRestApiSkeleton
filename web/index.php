<?php

require_once __DIR__ . '/../vendor/autoload.php';
$app = new Silex\Application();

$app->get('/asd', function() use($app) {
            echo "asd";
        });

$app->run();