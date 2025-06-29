<?php
class Reservation {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    public function create($data) {
        $sql = "INSERT INTO reservations (user_id, destination, date_depart, date_retour, nombre_personnes, type_voyage, budget) 
                VALUES (:user_id, :destination, :date_depart, :date_retour, :nombre_personnes, :type_voyage, :budget)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function findByUserId($userId) {
        $sql = "SELECT * FROM reservations WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll();
    }
    
    public function findById($id) {
        $sql = "SELECT * FROM reservations WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    public function update($id, $data) {
        $sql = "UPDATE reservations SET destination = :destination, date_depart = :date_depart, 
                date_retour = :date_retour, nombre_personnes = :nombre_personnes, 
                type_voyage = :type_voyage, budget = :budget WHERE id = :id";
        
        $data[':id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM reservations WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
    public function getStats($userId) {
        $sql = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN statut = 'confirmee' THEN 1 ELSE 0 END) as confirmees,
                    SUM(CASE WHEN statut = 'en_attente' THEN 1 ELSE 0 END) as en_attente,
                    SUM(CASE WHEN statut = 'annulee' THEN 1 ELSE 0 END) as annulees
                FROM reservations WHERE user_id = :user_id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetch();
    }
    
    public function getDuration($reservation) {
        $dateDepart = new DateTime($reservation['date_depart']);
        $dateRetour = new DateTime($reservation['date_retour']);
        return $dateDepart->diff($dateRetour)->days;
    }
    
    public function getStatutLabel($statut) {
        switch ($statut) {
            case 'en_attente': return 'En attente';
            case 'confirmee': return 'Confirmée';
            case 'annulee': return 'Annulée';
            default: return $statut;
        }
    }
}
?>