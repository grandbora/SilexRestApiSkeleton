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

        $controllers->post('/', function (Application $app) {

                    try {

                        $user = new User($app);
                        $user->fbId = $app['request']->get('fbId');
                        $user->type = $app['request']->get('type');
                        $user->position = $app['request']->get('position');
                        $user->save();

                        $app['monolog']->addInfo(sprintf('A new user (id : %s) is created.', $user->id));
                        return $app->json($user, 201);
                    } catch (Exception $exc) {
                        return new Response('Error in insert', 404);
                    }
                })->assert('id', '\d+');

        $controllers->post('/{id}', function (Application $app, $id) {
                    // this should be a put request but in that case update data can not be accessed easily

                    try {
                        $user = new User($app, $id);
                        $fbId = $app['request']->get('fbId');
                        $user->update(array('fbId' => $fbId));
                        $app['monolog']->addInfo(sprintf('User id : %s updated', $id));
                        return $app->json($user);
                    } catch (\Exception $e) {
                        return new Response('User cannot be found', 404);
                    }
                })->assert('id', '\d+');

        return $controllers;
    }

}