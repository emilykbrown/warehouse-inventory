<?php

class User {
    private $db;

    public function __construct($db) {
        require "../config/database.php"; // sets $conn
        $this->db = $db;
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM user_tbl WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>