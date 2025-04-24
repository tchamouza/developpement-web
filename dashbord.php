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
    <script src="scripts.js"></script>
</head>

<body>
    <nav class="menu-user">

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
        <a href="modifp.php" class="btn">Modifier le profil</a>
        <a href="deconnection.php" class="btn">Déconnexion</a>
    </nav>

    <div class="action-buttons">
        <a href="reservation.php" class="btn">Faire une réservation</a>
        <a href="mesreservations.php" class="btn">Mes reservations</a>
    </div>

    <script src="./scripts.js"></script>
</body>

</html>