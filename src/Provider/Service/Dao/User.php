<?php

namespace Provider\Service\Dao;

class User {

    private $db;

    public function __construct($db) {

        $this->db = $db;
    }

    public function load($id) {

        $sql = "SELECT id, fbId, type, position FROM user WHERE id = ?";
        return $this->db->fetchAssoc($sql, array((int) $id));
    }

    public function delete($id) {

        return $this->db->delete('user', array('id' => $id));
    }
}