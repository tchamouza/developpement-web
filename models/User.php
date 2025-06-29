<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    public function create($data) {
        $sql = "INSERT INTO users (nom, prenoms, date_naissance, email, telephone, photo_profil, mot_de_passe) 
                VALUES (:nom, :prenoms, :date_naissance, :email, :telephone, :photo_profil, :mot_de_passe)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $data['nom'],
            ':prenoms' => $data['prenoms'],
            ':date_naissance' => $data['date_naissance'],
            ':email' => $data['email'],
            ':telephone' => $data['telephone'],
            ':photo_profil' => $data['photo_profil'] ?? null,
            ':mot_de_passe' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }
    
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
    
    public function findById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    public function getFullName($user) {
        return $user['prenoms'] . ' ' . $user['nom'];
    }
}
?>