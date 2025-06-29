# AirlineTravel - Architecture MVC Simple

Application de réservation de voyages développée en PHP avec une architecture MVC simple.

## Structure du projet

```
/
├── index.php                 # Point d'entrée et routeur
├── config/
│   └── database.php         # Configuration de la base de données
├── controllers/             # Contrôleurs
│   ├── HomeController.php
│   ├── AuthController.php
│   ├── DashboardController.php
│   ├── ReservationController.php
│   └── ContactController.php
├── models/                  # Modèles
│   ├── User.php
│   ├── Reservation.php
│   ├── Destination.php
│   └── Contact.php
├── views/                   # Vues
│   ├── layout.php
│   ├── home.php
│   ├── dashboard.php
│   ├── services.php
│   ├── contact.php
│   ├── about.php
│   ├── 404.php
│   ├── auth/
│   │   ├── login.php
│   │   └── register.php
│   └── reservations/
│       └── create.php
└── public/                  # Ressources publiques
    ├── css/
    │   └── style.css
    ├── js/
    │   └── app.js
    └── images/
```

## Installation

1. **Configuration de la base de données**
   - Créez une base de données MySQL nommée `airline_travel`
   - Importez le fichier SQL fourni dans `supabase/migrations/`
   - Modifiez les paramètres de connexion dans `config/database.php`

2. **Configuration du serveur web**
   - Pointez votre serveur web vers le répertoire racine du projet
   - Assurez-vous que PHP 7.4+ est installé avec l'extension PDO MySQL

3. **Permissions**
   - Donnez les permissions d'écriture au dossier `public/images/profiles/`

## Fonctionnalités

- **Authentification** : Inscription et connexion des utilisateurs
- **Gestion des réservations** : Création, modification et suppression
- **Tableau de bord** : Vue d'ensemble des réservations
- **Contact** : Formulaire de contact
- **Destinations** : Affichage des destinations disponibles

## Architecture MVC

### Modèles (Models)
- `User.php` : Gestion des utilisateurs
- `Reservation.php` : Gestion des réservations
- `Destination.php` : Gestion des destinations
- `Contact.php` : Gestion des messages de contact

### Vues (Views)
- Templates PHP avec inclusion de layout commun
- Séparation du contenu et de la présentation
- Utilisation de Tailwind CSS pour le style

### Contrôleurs (Controllers)
- `HomeController` : Pages publiques
- `AuthController` : Authentification
- `DashboardController` : Tableau de bord utilisateur
- `ReservationController` : Gestion des réservations
- `ContactController` : Formulaire de contact

### Routeur
- Routeur simple dans `index.php`
- Gestion des routes GET et POST
- Autoloader pour les classes

## Sécurité

- Hachage des mots de passe avec `password_hash()`
- Protection contre les injections SQL avec PDO
- Échappement des données en sortie avec `htmlspecialchars()`
- Gestion des sessions pour l'authentification

## Utilisation

1. Accédez à l'application via votre navigateur
2. Inscrivez-vous ou connectez-vous
3. Explorez les destinations disponibles
4. Créez vos réservations
5. Gérez vos voyages depuis le tableau de bord