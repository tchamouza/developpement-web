<?php
class Reservation {
    private $conn;
    private $table_name = "reservations";

    public $id;
    public $user_id;
    public $destination;
    public $date_depart;
    public $date_retour;
    public $nombre_personnes;
    public $type_voyage;
    public $budget;
    public $statut;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET user_id=:user_id, destination=:destination, date_depart=:date_depart, 
                      date_retour=:date_retour, nombre_personnes=:nombre_personnes, 
                      type_voyage=:type_voyage, budget=:budget, statut='en_attente'";

        $stmt = $this->conn->prepare($query);

        // Nettoyage des données
        $this->destination = htmlspecialchars(strip_tags($this->destination));
        $this->type_voyage = htmlspecialchars(strip_tags($this->type_voyage));

        // Liaison des paramètres
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":destination", $this->destination);
        $stmt->bindParam(":date_depart", $this->date_depart);
        $stmt->bindParam(":date_retour", $this->date_retour);
        $stmt->bindParam(":nombre_personnes", $this->nombre_personnes);
        $stmt->bindParam(":type_voyage", $this->type_voyage);
        $stmt->bindParam(":budget", $this->budget);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getReservationsByUser($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllReservations() {
        $query = "SELECT r.*, u.nom, u.prenoms, u.email 
                  FROM " . $this->table_name . " r 
                  JOIN users u ON r.user_id = u.id 
                  ORDER BY r.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatut($id, $statut) {
        $query = "UPDATE " . $this->table_name . " SET statut = :statut WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>