<?php

namespace Provider;

use Silex\Application;
use Silex\ControllerProviderInterface;

class UtilControllerProvider implements ControllerProviderInterface {

    public function connect(Application $app) {

        $controllers = $app['controllers'];

        $controllers->get('/conf', function (Application $app) {

                    $app['monolog']->addInfo('Config route is requested.');

                    $config = $app['wisdom']->get('config.json');
                    return $app->json($config);
                });

        return $controllers;
    }

}