<?php

namespace Provider\Service\Model;

use Provider\Service\Dao\User as Dao;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class User {

    public $id;
    public $fbId;
    public $type;
    public $position;
    private $dao;

    public function __construct($app = null, $id = null) {

        if (null !== $app)
            $this->setDao(new Dao($app['db']));
        if (null !== $id)
            $this->load((int) $id);
    }

    protected function load($id) {

        $userData = $this->getDao()->load($id);
        if (false === $userData)
            throw new ResourceNotFoundException;

        $this->id = $userData['id'];
        $this->fbId = $userData['fbId'];
        $this->type = $userData['type'];
        $this->position = $userData['position'];
    }

    public function save() {

        $data = array('fbId' => $this->fbId, 'type' => $this->type, 'position' => $this->position);
        if (0 === $id = $this->getDao()->save($data))
            throw new \Exception;

        return $this->id = $id;
    }

    public function delete($id) {

        if (0 === $this->getDao()->delete($id))
            throw new \Exception;

        return true;
    }

    public function update(array $data) {
        $this->fbId = $data['fbId'];
        $this->getDao()->update($this->id, $this->fbId);
    }

    protected function setDao($dao) {
        $this->dao = $dao;
    }

    protected function getDao() {
        return $this->dao;
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