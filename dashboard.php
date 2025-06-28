<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: connexion.php");
    exit();
}

require_once 'controllers/ReservationController.php';
$reservationController = new ReservationController();
$reservations = $reservationController->getUserReservations($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="avion (1).png">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .reservations-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .reservation-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }
        .reservation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .status-en-attente {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-confirmee {
            background-color: #d4edda;
            color: #155724;
        }
        .status-annulee {
            background-color: #f8d7da;
            color: #721c24;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
            transition: transform 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
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
                <li><a href="index.php">Accueil</a></li>
                <li><a href="pages/Service.php">Services</a></li>
                <li><a href="reservation.php">Réserver</a></li>
                <li><a href="pages/Contact.php">Contact</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
        
        <div class="menu-toggle" id="mobile-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <div class="mobile-nav" id="mobile-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="pages/Service.php">Services</a></li>
                <li><a href="reservation.php">Réserver</a></li>
                <li><a href="pages/Contact.php">Contact</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="welcome-section">
            <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_prenoms'] . ' ' . $_SESSION['user_nom']); ?> !</h1>
            <p>Gérez vos voyages et découvrez de nouvelles destinations</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo count($reservations); ?></div>
                <div>Réservations totales</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    <?php 
                    $confirmees = array_filter($reservations, function($r) { return $r['statut'] == 'confirmee'; });
                    echo count($confirmees);
                    ?>
                </div>
                <div>Voyages confirmés</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    <?php 
                    $en_attente = array_filter($reservations, function($r) { return $r['statut'] == 'en_attente'; });
                    echo count($en_attente);
                    ?>
                </div>
                <div>En attente</div>
            </div>
        </div>

        <div class="reservations-section">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2>Mes Réservations</h2>
                <a href="reservation.php" class="btn-primary">Nouvelle Réservation</a>
            </div>

            <?php if (empty($reservations)): ?>
                <div style="text-align: center; padding: 40px;">
                    <p>Aucune réservation trouvée.</p>
                    <a href="reservation.php" class="btn-primary">Faire ma première réservation</a>
                </div>
            <?php else: ?>
                <?php foreach ($reservations as $reservation): ?>
                    <div class="reservation-card">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                            <h3><?php echo htmlspecialchars($reservation['destination']); ?></h3>
                            <span class="status-badge status-<?php echo $reservation['statut']; ?>">
                                <?php echo ucfirst(str_replace('_', ' ', $reservation['statut'])); ?>
                            </span>
                        </div>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                            <div>
                                <strong>Dates:</strong><br>
                                Du <?php echo date('d/m/Y', strtotime($reservation['date_depart'])); ?>
                                au <?php echo date('d/m/Y', strtotime($reservation['date_retour'])); ?>
                            </div>
                            <div>
                                <strong>Personnes:</strong> <?php echo $reservation['nombre_personnes']; ?><br>
                                <strong>Type:</strong> <?php echo htmlspecialchars($reservation['type_voyage']); ?>
                            </div>
                            <div>
                                <strong>Budget:</strong> <?php echo number_format($reservation['budget'], 0, ',', ' '); ?> €<br>
                                <strong>Réservé le:</strong> <?php echo date('d/m/Y', strtotime($reservation['created_at'])); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <div class="logo">
            <br>
            <p>© copyright @ 2025 par <a href="#">airline<span>TRAVEL</span></a>. Tous droits réservés.</p>
        </div>
        <p>📍 Adresse : Lomé-Togo</p>
        <p>📞 <a href="tel:+22892558895" style="color: gray;text-decoration: none;">Telephone</a></p>
        <p>📧 <a href="mailto:contact@airlinetravel.tg" style="color: gray;text-decoration: none;">contact@airlinetravel.tg</a></p>
    </footer>
</body>
</html>