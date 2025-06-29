<?php
class Contact {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    public function create($data) {
        $sql = "INSERT INTO contacts (nom, email, message) VALUES (:nom, :email, :message)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
?>