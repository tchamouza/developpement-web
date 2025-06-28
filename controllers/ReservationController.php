<?php
require_once 'config/database.php';
require_once 'models/Reservation.php';

class ReservationController {
    private $db;
    private $reservation;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->reservation = new Reservation($this->db);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error'] = "Vous devez être connecté pour faire une réservation.";
                header("Location: connexion.php");
                return;
            }

            $this->reservation->user_id = $_SESSION['user_id'];
            $this->reservation->destination = $_POST['destination'];
            $this->reservation->date_depart = $_POST['date_depart'];
            $this->reservation->date_retour = $_POST['date_retour'];
            $this->reservation->nombre_personnes = $_POST['nombre_personnes'];
            $this->reservation->type_voyage = $_POST['type_voyage'];
            $this->reservation->budget = $_POST['budget'];

            if ($this->reservation->create()) {
                $_SESSION['success'] = "Réservation créée avec succès !";
                header("Location: dashboard.php");
            } else {
                $_SESSION['error'] = "Erreur lors de la création de la réservation.";
                header("Location: reservation.php");
            }
        }
    }

    public function getUserReservations($user_id) {
        return $this->reservation->getReservationsByUser($user_id);
    }

    public function getAllReservations() {
        return $this->reservation->getAllReservations();
    }
}
?>