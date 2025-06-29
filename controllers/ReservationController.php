<?php
class ReservationController {
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $destinationModel = new Destination();
        $destinations = $destinationModel->getAll();
        
        include 'views/reservations/create.php';
    }
    
    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $data = [
            ':user_id' => $_SESSION['user_id'],
            ':destination' => $_POST['destination'] ?? '',
            ':date_depart' => $_POST['date_depart'] ?? '',
            ':date_retour' => $_POST['date_retour'] ?? '',
            ':nombre_personnes' => $_POST['nombre_personnes'] ?? '',
            ':type_voyage' => $_POST['type_voyage'] ?? '',
            ':budget' => $_POST['budget'] ?? ''
        ];
        
        // Validation simple
        if (empty($data[':destination']) || empty($data[':date_depart']) || empty($data[':date_retour'])) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires.';
            header('Location: /reservations/create');
            exit;
        }
        
        $reservationModel = new Reservation();
        if ($reservationModel->create($data)) {
            $_SESSION['success'] = 'Réservation créée avec succès !';
        } else {
            $_SESSION['error'] = 'Erreur lors de la création de la réservation.';
        }
        
        header('Location: /dashboard');
        exit;
    }
    
    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $reservationModel = new Reservation();
        $reservation = $reservationModel->findById($id);
        
        if (!$reservation || $reservation['user_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'Réservation non trouvée.';
            header('Location: /dashboard');
            exit;
        }
        
        if ($reservation['statut'] !== 'en_attente') {
            $_SESSION['error'] = 'Cette réservation ne peut plus être modifiée.';
            header('Location: /dashboard');
            exit;
        }
        
        $destinationModel = new Destination();
        $destinations = $destinationModel->getAll();
        
        include 'views/reservations/edit.php';
    }
    
    public function update($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $reservationModel = new Reservation();
        $reservation = $reservationModel->findById($id);
        
        if (!$reservation || $reservation['user_id'] != $_SESSION['user_id'] || $reservation['statut'] !== 'en_attente') {
            $_SESSION['error'] = 'Impossible de modifier cette réservation.';
            header('Location: /dashboard');
            exit;
        }
        
        $data = [
            ':destination' => $_POST['destination'] ?? '',
            ':date_depart' => $_POST['date_depart'] ?? '',
            ':date_retour' => $_POST['date_retour'] ?? '',
            ':nombre_personnes' => $_POST['nombre_personnes'] ?? '',
            ':type_voyage' => $_POST['type_voyage'] ?? '',
            ':budget' => $_POST['budget'] ?? ''
        ];
        
        if ($reservationModel->update($id, $data)) {
            $_SESSION['success'] = 'Réservation mise à jour avec succès !';
        } else {
            $_SESSION['error'] = 'Erreur lors de la mise à jour.';
        }
        
        header('Location: /dashboard');
        exit;
    }
    
    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $reservationModel = new Reservation();
        $reservation = $reservationModel->findById($id);
        
        if (!$reservation || $reservation['user_id'] != $_SESSION['user_id'] || $reservation['statut'] !== 'en_attente') {
            $_SESSION['error'] = 'Impossible de supprimer cette réservation.';
            header('Location: /dashboard');
            exit;
        }
        
        if ($reservationModel->delete($id)) {
            $_SESSION['success'] = 'Réservation supprimée avec succès !';
        } else {
            $_SESSION['error'] = 'Erreur lors de la suppression.';
        }
        
        header('Location: /dashboard');
        exit;
    }
}
?>