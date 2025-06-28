<?php
require_once 'config/database.php';
require_once 'models/Contact.php';

class ContactController {
    private $db;
    private $contact;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->contact = new Contact($this->db);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->contact->nom = $_POST['name'];
            $this->contact->email = $_POST['email'];
            $this->contact->message = $_POST['message'];

            if ($this->contact->create()) {
                $_SESSION['success'] = "Message envoyé avec succès !";
                header("Location: pages/Contact.php");
            } else {
                $_SESSION['error'] = "Erreur lors de l'envoi du message.";
                header("Location: pages/Contact.php");
            }
        }
    }
}
?>