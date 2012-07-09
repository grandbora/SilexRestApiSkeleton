<?php

namespace Test\Integration;

abstract class BaseFixture {

    protected $dbScript;

    public function __construct() {
        $this->setDbScript();
    }

    public function getDbScript() {
        return $this->dbScript;
    }

    abstract protected function setDbScript();
}