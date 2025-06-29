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

// Supprimer les slashes en fin d'URL
$path = rtrim($path, '/');
if (empty($path)) {
    $path = '/';
}

// Routes
switch (true) {
    case $path === '/' || $path === '/home':
        $controller = new HomeController();
        $controller->index();
        break;
        
    case $path === '/services':
        $controller = new HomeController();
        $controller->services();
        break;
        
    case $path === '/about':
        $controller = new HomeController();
        $controller->about();
        break;
        
    case $path === '/contact':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ContactController();
            $controller->store();
        } else {
            $controller = new ContactController();
            $controller->create();
        }
        break;
        
    case $path === '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AuthController();
            $controller->login();
        } else {
            $controller = new AuthController();
            $controller->showLogin();
        }
        break;
        
    case $path === '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AuthController();
            $controller->register();
        } else {
            $controller = new AuthController();
            $controller->showRegister();
        }
        break;
        
    case $path === '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case $path === '/dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;
        
    case $path === '/reservations/create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ReservationController();
            $controller->store();
        } else {
            $controller = new ReservationController();
            $controller->create();
        }
        break;
        
    case preg_match('/^\/reservations\/(\d+)\/edit$/', $path, $matches):
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ReservationController();
            $controller->update($matches[1]);
        } else {
            $controller = new ReservationController();
            $controller->edit($matches[1]);
        }
        break;
        
    case preg_match('/^\/reservations\/(\d+)\/delete$/', $path, $matches):
        $controller = new ReservationController();
        $controller->delete($matches[1]);
        break;
        
    default:
        http_response_code(404);
        include 'views/404.php';
        break;
}
?>