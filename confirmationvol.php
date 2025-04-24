<?php
require 'config.php';
session_start();

if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit();
}

// Récupération de la dernière réservation
$stmt = $pdo->prepare("SELECT * FROM reservation WHERE email = ? ORDER BY id DESC LIMIT 1");
$stmt->execute([$_SESSION['utilisateur']['email']]);
$reservation = $stmt->fetch();

if (!$reservation) {
    header('Location: reservation.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="voyage.png">
    <title>Confirmation de Réservation</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <div class="confirmation-container">
        <h1 class="confirmation-title">Confirmation de Réservation</h1>
        <p class="confirmation-subtitle">Votre vol a été réservé avec succès !</p>

        <div class="ticket">
            <div class="flight-number-badge">
                Vol <?= htmlspecialchars($reservation['numerodevol']) ?>
            </div>
            
            <div class="ticket-header">
                <div>
                    <p style="font-weight: bold; font-size: 1.2rem;">AIRLINE TRAVEL</p>
                    <p>E-ticket</p>
                </div>
                <div style="text-align: right;">
                    <p>Émis le: <?= date('d/m/Y') ?></p>
                    <p>Statut: <span style="color: green; font-weight: bold;">CONFIRMÉ</span></p>
                </div>
            </div>

            <div class="ticket-body">
                <div>
                    <div class="info-group">
                        <span class="info-label">Passager</span>
                        <p><?= htmlspecialchars($reservation['name']) ?></p>
                    </div>
                    <div class="info-group">
                        <span class="info-label">Référence</span>
                        <p style="font-weight: bold;"><?= htmlspecialchars($reservation['numerodevol']) ?></p>
                    </div>
                    <div class="info-group">
                        <span class="info-label">Email</span>
                        <p><?= htmlspecialchars($reservation['email']) ?></p>
                    </div>
                    <div class="info-group">
                        <span class="info-label">Téléphone</span>
                        <p><?= htmlspecialchars($reservation['phone']) ?></p>
                    </div>
                </div>
                <div>
                    <div class="info-group">
                        <span class="info-label">Départ</span>
                        <p><?= htmlspecialchars($reservation['depart']) ?></p>
                    </div>
                    <div class="info-group">
                        <span class="info-label">Destination</span>
                        <p><?= htmlspecialchars($reservation['arrive']) ?></p>
                    </div>
                    <div class="info-group">
                        <span class="info-label">Date</span>
                        <p><?= date('d/m/Y', strtotime($reservation['date'])) ?></p>
                    </div>
                    <div class="info-group">
                        <span class="info-label">Tarif</span>
                        <p style="font-size: 1.2rem; font-weight: bold; color: midnightblue;">
                            <?= htmlspecialchars($reservation['tarif']) ?> €
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="reservation.php" class="btn btn-primary">Nouvelle réservation</a>
            <a href="dashbord.php" class="btn btn-secondary">Mon Profil</a>
        </div>
    </div>
</body>
</html>