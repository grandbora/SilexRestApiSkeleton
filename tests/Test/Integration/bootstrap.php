<?php

$baseDir = dirname(dirname(dirname(__DIR__)));

$loader = require_once $baseDir . '/app/bootstrap.php';
$loader->add('Test', $baseDir . '/tests');