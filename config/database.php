<?php
// Configuration de la base de données pour airlineTRAVEL

// Paramètres de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'airline_travel');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Fonction pour obtenir une connexion PDO
function getDB() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    
    return $pdo;
}

// Test de connexion (optionnel - à supprimer en production)
function testConnection() {
    try {
        $pdo = getDB();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>