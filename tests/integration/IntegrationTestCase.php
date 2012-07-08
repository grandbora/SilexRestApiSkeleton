<?php

namespace Tests;

use Silex\WebTestCase;

class IntegrationTestCase extends WebTestCase {

    private $tables;

    public function createApplication() {
        $app = require dirname(dirname(__DIR__)) . '/app/app.php';
        return $app;
    }

    public function setUp() {
        parent::setUp();
        
        // @todo insert fixtures here
    }

    public function tearDown() {
        foreach ($this->getTables() as $table) {
            $this->app['db']->executeQuery("TRUNCATE $table");
        }
    }

    private function getTables() {
        if (null === $this->tables)
            $tables = $this->app['db']->fetchArray("SHOW TABLES");
        return $tables;
    }

}