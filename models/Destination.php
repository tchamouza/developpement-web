<?php
class Destination {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    public function getAll() {
        $sql = "SELECT * FROM destinations ORDER BY nom";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getPopular($limit = 6) {
        $sql = "SELECT * FROM destinations ORDER BY nom LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>