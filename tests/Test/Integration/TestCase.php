<?php

namespace Test\Integration;

use Silex\WebTestCase;

class TestCase extends WebTestCase {

    private $tables;

    public function createApplication() {
        $app = require dirname(dirname(dirname(__DIR__))) . '/app/app.php';
        return $app;
    }

    public function setUp() {
        parent::setUp();

        //run fixture scripts
        $nameList = explode('\\', get_class($this));
        array_splice($nameList, count($nameList) - 1, 0, 'Fixture');
        $fixtureClass = implode('\\', $nameList);
        if (class_exists($fixtureClass)) {
            $fixture = new $fixtureClass();
            $this->app['db']->executeQuery($fixture->getDbScript());
        }
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