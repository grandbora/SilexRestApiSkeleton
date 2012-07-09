<?php

namespace Test\Integration\Provider\Service\Model;

use Test\Integration\TestCase;
use Provider\Service\Model\User;

class UserTest extends TestCase {

    public function testConstructor() {

        $user = new User($this->app, 1);
        $this->assertEquals(1, $user->id);
        $this->assertEquals(1, $user->fbId);
        $this->assertEquals(2, $user->type);
        $this->assertEquals('position', $user->position);
    }

    public function testSave() {

        $user = new User($this->app);
        $user->setFbId('33');
        $user->setType('44');
        $user->setPosition('testpos');
        $user->save();

        $id = $user->getId();
        $newUser = new User($this->app, $id);

        $this->assertEquals($user, $newUser);
    }

    /**
     * @expectedException Symfony\Component\Routing\Exception\ResourceNotFoundException
     * @expectedExceptionMessage 
     */
    public function testDelete() {

        $user = new User($this->app);
        $user->delete(1);

        $user = new User($this->app, 1);
    }

    public function testUpdate() {

        $user = new User($this->app, 1);
        $user->update(array('fbId' => 777));

        $newUser = new User($this->app, 1);
        $this->assertEquals($user, $newUser);
        $this->assertEquals(777, $newUser->fbId);
    }

}