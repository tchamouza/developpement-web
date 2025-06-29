<?php
class DashboardController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $reservationModel = new Reservation();
        $reservations = $reservationModel->findByUserId($_SESSION['user_id']);
        $stats = $reservationModel->getStats($_SESSION['user_id']);
        
        include 'views/dashboard.php';
    }
}
?>