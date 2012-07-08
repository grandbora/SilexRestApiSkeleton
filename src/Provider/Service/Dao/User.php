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

    public function update($id, $fbId) {
        return $this->db->update('user', array('fbId' => $fbId), array('id' => $id));
    }

    public function save(array $data) {

        if (0 === $this->db->insert('user', $data))
            return 0;

        return $this->db->lastInsertId();
    }

    public function delete($id) {

        return $this->db->delete('user', array('id' => $id));
    }

}