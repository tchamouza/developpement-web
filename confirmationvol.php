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
    <style>
        .confirmation-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .ticket {
            border: 2px solid midnightblue;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            background: #f8f9fa;
            position: relative;
        }
        .flight-number-badge {
            position: absolute;
            top: -15px;
            right: 20px;
            background: midnightblue;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px dashed midnightblue;
            padding-bottom: 15px;
            margin-bottom: 15px;
            margin-top: 10px;
        }
        .ticket-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-group {
            margin-bottom: 15px;
        }
        .info-label {
            font-weight: bold;
            color: midnightblue;
            display: block;
            margin-bottom: 5px;
        }
        .action-buttons {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
            display: inline-block;
        }
        .btn-primary {
            background: midnightblue;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .confirmation-title {
            text-align: center;
            color: midnightblue;
            margin-bottom: 10px;
        }
        .confirmation-subtitle {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="#">airline<span>TRAVEL</span></a>
        </div>
        <nav>
            <ul>
                <li><a href="./dashbord.php">Profil</a></li>
                <li><a href="deconnection.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

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