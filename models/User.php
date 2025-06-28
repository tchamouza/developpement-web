<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $nom;
    public $prenoms;
    public $date_naissance;
    public $email;
    public $telephone;
    public $photo_profil;
    public $mot_de_passe;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nom=:nom, prenoms=:prenoms, date_naissance=:date_naissance, 
                      email=:email, telephone=:telephone, photo_profil=:photo_profil, 
                      mot_de_passe=:mot_de_passe";

        $stmt = $this->conn->prepare($query);

        // Nettoyage des données
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenoms = htmlspecialchars(strip_tags($this->prenoms));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telephone = htmlspecialchars(strip_tags($this->telephone));
        $this->mot_de_passe = password_hash($this->mot_de_passe, PASSWORD_DEFAULT);

        // Liaison des paramètres
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenoms", $this->prenoms);
        $stmt->bindParam(":date_naissance", $this->date_naissance);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":photo_profil", $this->photo_profil);
        $stmt->bindParam(":mot_de_passe", $this->mot_de_passe);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $query = "SELECT id, nom, prenoms, email, mot_de_passe FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row && password_verify($password, $row['mot_de_passe'])) {
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->prenoms = $row['prenoms'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }

    public function emailExists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>