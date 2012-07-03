<?php

require_once __DIR__ . '/bootstrap.php';

$app = new Silex\Application();
$app->mount('/users', new Provider\UserControllerProvider());

return $app;