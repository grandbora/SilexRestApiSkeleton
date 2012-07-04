<?php

namespace Provider\Service\Model;

class User {

    public $id;
    public $fbId;
    public $type;
    public $position;

    public function __construct($id = null) {
        if (null !== $id)
            $this->load((int) $id);
    }

    private function load($id) {
        $this->id = (int) $id;
        $this->fbId = 'dummmy';
        $this->type = 'dummmy';
        $this->position = 'dummmy';
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setFbId($fbId) {
        $this->fbId = (int) $fbId;
    }

    public function getFbId() {
        return $this->fbId;
    }

    public function setType($type) {
        $this->type = (int) $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setPosition($position) {
        $this->position = (int) $position;
    }

    public function getPosition() {
        return $this->position;
    }

}