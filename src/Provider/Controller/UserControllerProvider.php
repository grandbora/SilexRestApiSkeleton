<?php

namespace Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Provider\Service\Model\User;
use Symfony\Component\HttpFoundation\Response;

class UserControllerProvider implements ControllerProviderInterface {

    public function connect(Application $app) {

        $controllers = $app['controllers'];

        $controllers->get('/{id}', function (Application $app, $id) {

                    try {
                        $user = new User($app, $id);
                        $app['monolog']->addInfo(sprintf('User id : %s served', $id));
                        return $app->json($user);
                    } catch (\Exception $e) {
                        return new Response('User cannot be found', 404);
                    }
                })->assert('id', '\d+');

        $controllers->delete('/{id}', function (Application $app, $id) {

                    try {
                        $user = new User($app);
                        $user->delete($id);
                        $app['monolog']->addInfo(sprintf('User id : %s deleted', $id));
                        return $app->json(true);
                    } catch (\Exception $e) {
                        return new Response('User cannot be found', 404);
                    }
                })->assert('id', '\d+');


        $controllers->put('/{id}', function (Application $app, $id) {


                    // tobe continued
                    //$param = $request->get('paramname');
                    //try {
                    //    return $app->json(true);
                    //} catch (\Exception $e) {
                    //    return new Response('User cannot be found', 404);
                    //}

                    $user = new \stdClass();
                    $user->id = $id;
                    $user->name = 'test';

                    $app['monolog']->addInfo(sprintf('User id : %s updated', $id));
                    return $app->json($user);
                })->assert('id', '\d+');

        $controllers->post('/', function (Application $app) {

                    $user = new \stdClass();
                    $user->type = 'test';
                    $user->position = 'test';

                    $app['monolog']->addInfo('A new user is created and saved.');
                    return $app->json($user, 201);
                })->assert('id', '\d+');

        return $controllers;
    }

}