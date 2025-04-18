<?php
require 'config.php';
session_start();

// Vérification de la session
if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit();
}

// Suppression automatique des réservations expirées (plus anciennes que 30 jours)
$dateLimite = date('Y-m-d', strtotime('-30 days'));
$stmt = $pdo->prepare("DELETE FROM reservation WHERE email = ? AND date < ?");
$stmt->execute([$_SESSION['utilisateur']['email'], $dateLimite]);

// Récupération des réservations actuelles de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM reservation WHERE email = ? ORDER BY date DESC");
$stmt->execute([$_SESSION['utilisateur']['email']]);
$reservations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="avion (1).png">
    <title>Mes Réservations - Airline Travel</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        .reservations-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }

        .page-title {
            color: midnightblue;
            text-align: center;
            margin-bottom: 30px;
        }

        .reservation-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            border-left: 4px solid midnightblue;
        }

        .reservation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .flight-number {
            background: midnightblue;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .reservation-date {
            color: #666;
            font-size: 0.9rem;
        }

        .reservation-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .route {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .departure,
        .arrival {
            font-weight: bold;
        }

        .arrow {
            font-size: 1.2rem;
            color: midnightblue;
        }

        .info-group {
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: bold;
            color: midnightblue;
            display: block;
            margin-bottom: 3px;
            font-size: 0.9rem;
        }

        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: midnightblue;
            text-align: right;
        }

        .no-reservations {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 1.1rem;
        }

        .action-buttons {
            margin-top: 30px;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
            font-weight: bold;
        }

        .btn-primary {
            background: midnightblue;
            color: white;
        }

        .expiry-info {
            font-size: 0.8rem;
            color: #666;
            text-align: center;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="avion (1).png" alt="Logo du site" width="30px" height="30px">

            <a href="#">airline<span>TRAVEL</span></a>
        </div>
        <nav>
            <ul>
                <li><a href="./dashbord.php">profil</a></li>

                <li><a href="deconnection.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <div class="reservations-container">
        <h1 class="page-title">Mes Réservations</h1>

        <?php if (empty($reservations)): ?>
            <div class="no-reservations">
                <p>Vous n'avez aucune réservation pour le moment.</p>
                <a href="reservation.php" class="btn btn-primary">Faire une réservation</a>
            </div>
        <?php else: ?>
            <?php foreach ($reservations as $reservation): ?>
                <div class="reservation-card">
                    <div class="reservation-header">
                        <span class="flight-number">Vol <?= htmlspecialchars($reservation['numerodevol']) ?></span>
                        <span class="reservation-date">Réservé le <?= date('d/m/Y', strtotime($reservation['date'])) ?></span>
                    </div>

                    <div class="reservation-body">
                        <div>
                            <div class="route">
                                <span class="departure"><?= htmlspecialchars($reservation['depart']) ?></span>
                                <span class="arrow">→</span>
                                <span class="arrival"><?= htmlspecialchars($reservation['arrive']) ?></span>
                            </div>

                            <div class="info-group">
                                <span class="info-label">Date de vol</span>
                                <p><?= date('d/m/Y', strtotime($reservation['date'])) ?></p>
                            </div>

                            <div class="info-group">
                                <span class="info-label">Passager</span>
                                <p><?= htmlspecialchars($reservation['name']) ?></p>
                            </div>
                        </div>

                        <div>
                            <div class="info-group">
                                <span class="info-label">Référence</span>
                                <p><?= htmlspecialchars($reservation['numerodevol']) ?></p>
                            </div>

                            <div class="info-group">
                                <span class="info-label">Contact</span>
                                <p><?= htmlspecialchars($reservation['email']) ?></p>
                                <p><?= htmlspecialchars($reservation['phone']) ?></p>
                            </div>

                            <div class="price">
                                <?= htmlspecialchars($reservation['tarif']) ?> €
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="expiry-info">
                <p>Les réservations sont automatiquement supprimées après 30 jours.</p>
            </div>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="reservation.php" class="btn btn-primary">Faire une nouvelle réservation</a>
        </div>
    </div>
</body>

</html>