<?php
class ContactController {
    public function create() {
        include 'views/contact.php';
    }
    
    public function store() {
        $data = [
            ':nom' => $_POST['nom'] ?? '',
            ':email' => $_POST['email'] ?? '',
            ':message' => $_POST['message'] ?? ''
        ];
        
        if (empty($data[':nom']) || empty($data[':email']) || empty($data[':message'])) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs.';
            header('Location: /contact');
            exit;
        }
        
        $contactModel = new Contact();
        if ($contactModel->create($data)) {
            $_SESSION['success'] = 'Message envoyé avec succès !';
        } else {
            $_SESSION['error'] = 'Erreur lors de l\'envoi du message.';
        }
        
        header('Location: /contact');
        exit;
    }
}
?>