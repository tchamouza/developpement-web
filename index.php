<?php
session_start();

// Configuration de base
define('BASE_PATH', __DIR__);
define('BASE_URL', 'http://localhost');

// Autoloader simple
spl_autoload_register(function ($class) {
    $file = BASE_PATH . '/controllers/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    $file = BASE_PATH . '/models/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
});

// Configuration de la base de données
require_once 'config/database.php';

// Routeur simple
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Routes
switch ($path) {
    case '/':
    case '/home':
        $controller = new HomeController();
        $controller->index();
        break;
        
    case '/services':
        $controller = new HomeController();
        $controller->services();
        break;
        
    case '/about':
        $controller = new HomeController();
        $controller->about();
        break;
        
    case '/contact':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ContactController();
            $controller->store();
        } else {
            $controller = new ContactController();
            $controller->create();
        }
        break;
        
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AuthController();
            $controller->login();
        } else {
            $controller = new AuthController();
            $controller->showLogin();
        }
        break;
        
    case '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AuthController();
            $controller->register();
        } else {
            $controller = new AuthController();
            $controller->showRegister();
        }
        break;
        
    case '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case '/dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;
        
    case '/reservations/create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ReservationController();
            $controller->store();
        } else {
            $controller = new ReservationController();
            $controller->create();
        }
        break;
        
    case (preg_match('/\/reservations\/(\d+)\/edit/', $path, $matches) ? true : false):
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ReservationController();
            $controller->update($matches[1]);
        } else {
            $controller = new ReservationController();
            $controller->edit($matches[1]);
        }
        break;
        
    case (preg_match('/\/reservations\/(\d+)\/delete/', $path, $matches) ? true : false):
        $controller = new ReservationController();
        $controller->delete($matches[1]);
        break;
        
    default:
        http_response_code(404);
        include 'views/404.php';
        break;
}
?>