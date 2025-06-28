# airlineTRAVEL - Site de Voyage avec Architecture MVC PHP

## Description
Site web de réservation de voyages développé avec l'architecture MVC en PHP. Le site permet aux utilisateurs de s'inscrire, se connecter, consulter les destinations et faire des réservations.

## Fonctionnalités

### Authentification
- Inscription avec upload de photo de profil
- Connexion sécurisée avec hachage des mots de passe
- Gestion des sessions utilisateur
- Déconnexion

### Gestion des Réservations
- Création de réservations avec choix de destination, dates, nombre de personnes
- Tableau de bord utilisateur avec historique des réservations
- Statuts de réservation (en attente, confirmée, annulée)

### Contact
- Formulaire de contact fonctionnel
- Stockage des messages en base de données

### Interface
- Design responsive avec menu burger pour mobile
- Pages d'accueil, services, à propos
- Navigation dynamique selon l'état de connexion

## Structure du Projet

```
/
├── config/
│   └── database.php          # Configuration base de données
├── models/
│   ├── User.php             # Modèle utilisateur
│   ├── Reservation.php      # Modèle réservation
│   └── Contact.php          # Modèle contact
├── controllers/
│   ├── AuthController.php   # Contrôleur authentification
│   ├── ReservationController.php # Contrôleur réservations
│   └── ContactController.php # Contrôleur contact
├── views/
│   ├── dashboard.php        # Tableau de bord utilisateur
│   └── reservation.php      # Formulaire de réservation
├── pages/
│   ├── Service.php          # Page services
│   └── Contact.php          # Page contact
├── database/
│   └── schema.sql           # Structure de la base de données
├── uploads/
│   └── profiles/            # Dossier pour les photos de profil
├── index.php                # Page d'accueil
├── connexion.php            # Page de connexion
├── inscription.php          # Page d'inscription
├── logout.php               # Script de déconnexion
├── A-propos.php            # Page à propos
├── style.css               # Styles CSS
└── scripts.js              # Scripts JavaScript
```

## Installation

1. **Prérequis**
   - Serveur web (Apache/Nginx)
   - PHP 7.4 ou supérieur
   - MySQL 5.7 ou supérieur

2. **Configuration de la base de données**
   ```sql
   -- Créer la base de données
   CREATE DATABASE airline_travel;
   
   -- Importer le schéma
   mysql -u root -p airline_travel < database/schema.sql
   ```

3. **Configuration**
   - Modifier les paramètres de connexion dans `config/database.php`
   - Créer le dossier `uploads/profiles/` avec les permissions d'écriture

4. **Démarrage**
   - Placer les fichiers dans le répertoire web
   - Accéder à `index.php` dans le navigateur

## Utilisation

1. **Inscription** : Créer un compte avec photo de profil
2. **Connexion** : Se connecter avec email/mot de passe
3. **Réservation** : Accéder au formulaire de réservation depuis le tableau de bord
4. **Gestion** : Consulter ses réservations dans le tableau de bord

## Sécurité

- Mots de passe hachés avec `password_hash()`
- Protection contre les injections SQL avec PDO
- Validation et nettoyage des données d'entrée
- Gestion sécurisée des sessions

## Technologies Utilisées

- **Backend** : PHP 7.4+, MySQL
- **Frontend** : HTML5, CSS3, JavaScript
- **Architecture** : MVC (Model-View-Controller)
- **Base de données** : MySQL avec PDO
- **Sécurité** : Sessions PHP, hachage des mots de passe

## Auteur

Développé pour airlineTRAVEL - Agence de voyage basée à Lomé, Togo.