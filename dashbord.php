<?php
require 'config.php';
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
header("Pragma: no-cache");

if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit;
}

$utilisateur = $_SESSION['utilisateur'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="avion (1).png">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            text-align: center;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid midnightblue;
            margin-bottom: 15px;
        }

        .profile-name {
            color: midnightblue;
            margin: 10px 0;
            font-size: 24px;
        }

        .action-buttons {
            text-align: center;
            margin: 20px 0;
        }

        .btn {
            background-color: black;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: red;
            color: white;
        }
    </style>
    <script src="scripts.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="avion (1).png" alt="Logo du site" width="30px" height="30px">

            <a href="#">airline<span>TRAVEL</span></a>
        </div>
        <nav>
            <ul>
                <li><a href="./index.html">Accueil</a></li>
                <li><a href="./pages/Service.html">Services</a></li>
                <li><a href="deconnection.php">Déconnexion</a></li>
                <li><a href="./pages/Contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="profile-section">
        <?php if (!empty($utilisateur['image']) && file_exists('uploads/' . $utilisateur['image'])): ?>
            <img src="uploads/<?= htmlspecialchars($utilisateur['image']) ?>"
                alt="Photo de profil de <?= htmlspecialchars($utilisateur['nom']) ?>"
                class="profile-image">
        <?php else: ?>
            <img src="images/default-profile.png" alt="Photo de profil par défaut" class="profile-image">
        <?php endif; ?>

        <h1 class="profile-name">
            <?= htmlspecialchars($utilisateur['nom']) . ' ' . htmlspecialchars($utilisateur['prenoms']) ?>
        </h1>
    </section>

    <div class="action-buttons">
        <a href="reservation.php" class="btn">Faire une réservation</a>
        <a href="mesreservations.php" class="btn">Mes reservations</a>
        <a href="modifp.php" class="btn">Modifier le profil</a>
    </div>

    <script src="./scripts.js"></script>
</body>

</html>