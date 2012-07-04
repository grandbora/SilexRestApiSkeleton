<?php

namespace Provider;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class UserControllerProvider implements ControllerProviderInterface {

    public function connect(Application $app) {

        $controllers = $app['controllers'];

        $controllers->get('/{id}', function (Application $app, $id) {

                    $config = $app['wisdom']->get('config.json');
                    var_dump($config);

                    // serve user data        
                    $user = new \stdClass();
                    $user->id = $id;
                    $user->name = 'test';
                    return $app->json($user);
                })->assert('id', '\d+');

        $controllers->delete('/{id}', function (Application $app, $id) {
                    // delete user
                    return $app->json(true);
                })->assert('id', '\d+');


        $controllers->put('/{id}', function (Application $app, $id) {

                    // update user
                    $user = new \stdClass();
                    $user->id = $id;
                    $user->name = 'test';
                    return $app->json($user);
                })->assert('id', '\d+');

        $controllers->post('/{id}', function (Application $app, $id) {

                    // create user
                    $user = new \stdClass();
                    $user->id = $id;
                    $user->name = 'test';
                    return $app->json($user, 201);
                })->assert('id', '\d+');

        return $controllers;
    }

}