<?php
class HomeController {
    public function index() {
        $destinationModel = new Destination();
        $destinations = $destinationModel->getPopular(6);
        
        include 'views/home.php';
    }
    
    public function services() {
        $destinationModel = new Destination();
        $destinations = $destinationModel->getAll();
        
        include 'views/services.php';
    }
    
    public function about() {
        include 'views/about.php';
    }
}
?>