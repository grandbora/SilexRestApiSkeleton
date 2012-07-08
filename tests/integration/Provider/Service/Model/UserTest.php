<?php

namespace Tests\Provider\Service\Model;

use Tests\IntegrationTestCase;
use Provider\Service\Model\User;

class UserTest extends IntegrationTestCase {

    public function testConstructor() {

        $user = new User($this->app, 1);
        $this->assertEquals(1, $user->id);
    }

}