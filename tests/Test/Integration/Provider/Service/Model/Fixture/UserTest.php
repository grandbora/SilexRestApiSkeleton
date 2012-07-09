<?php

namespace Test\Integration\Provider\Service\Model\Fixture;

use Test\Integration\BaseFixture;

class UserTest extends BaseFixture {

    public function setDbScript() {
        $this->dbScript = <<<SQL
INSERT INTO `user` (id, fbId, type, position) VALUES (1,1,2,'position');
SQL;
    }

}