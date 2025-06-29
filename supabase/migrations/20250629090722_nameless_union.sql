-- Base de données pour airlineTRAVEL
-- Architecture MVC Simple en PHP

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS airline_travel;
USE airline_travel;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenoms VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    photo_profil VARCHAR(255),
    mot_de_passe VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des réservations
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    destination VARCHAR(100) NOT NULL,
    date_depart DATE NOT NULL,
    date_retour DATE NOT NULL,
    nombre_personnes VARCHAR(10) NOT NULL,
    type_voyage VARCHAR(50) NOT NULL,
    budget VARCHAR(20) NOT NULL,
    statut ENUM('en_attente', 'confirmee', 'annulee') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table des messages de contact
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des destinations
CREATE TABLE IF NOT EXISTS destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    pays VARCHAR(100) NOT NULL,
    description TEXT,
    prix_base DECIMAL(10,2),
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion de quelques destinations par défaut
INSERT INTO destinations (nom, pays, description, prix_base, image) VALUES
('Paris', 'France', 'La ville lumière avec ses monuments emblématiques', 800.00, 'paris-france.jpeg'),
('Tokyo', 'Japon', 'Découvrez la culture japonaise et la modernité', 1200.00, 'japon.jpg'),
('Le Caire', 'Égypte', 'Explorez les pyramides et l\'histoire antique', 600.00, 'egypt.jpg'),
('Rio de Janeiro', 'Brésil', 'Plages paradisiaques et ambiance tropicale', 900.00, 'bresil.jpg'),
('Rome', 'Italie', 'Art, histoire et gastronomie italienne', 700.00, 'italie.jpg'),
('Kingston', 'Jamaïque', 'Détente et culture caribéenne', 1000.00, 'jamaique.jpg'),
('Athènes', 'Grèce', 'Berceau de la civilisation occidentale', 650.00, 'grece.jpg'),
('Bangkok', 'Thaïlande', 'Temples dorés et cuisine exotique', 750.00, 'thailande.jpg'),
('Malé', 'Maldives', 'Paradis tropical aux eaux cristallines', 1500.00, 'maldives.jpg'),
('New York', 'États-Unis', 'La ville qui ne dort jamais', 1100.00, 'usa.jpg');

-- Index pour optimiser les performances
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_reservations_user_id ON reservations(user_id);
CREATE INDEX idx_reservations_statut ON reservations(statut);
CREATE INDEX idx_reservations_date_depart ON reservations(date_depart);
CREATE INDEX idx_destinations_nom ON destinations(nom);