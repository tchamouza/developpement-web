<?php
require 'config.php';
session_start();

// Sécurité des en-têtes
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
header("Pragma: no-cache");

// Vérification de l'authentification
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
    <style>
        :root {
            --primary-color: midnightblue;
            --secondary-color: #333;
            --accent-color: #d9534f;
            --light-gray: #f8f9fa;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: #333;
        }

        .dashboard-header {
            display: flex;
            justify-content: flex-end;
            padding: 15px 30px;
            background-color: black;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown {
            position: relative;
        }

        .dropbtn {
            background-color:black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }

        .dropbtn:hover {
            background-color:rgba(214, 153, 40, 0.932);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--white);
            min-width: 250px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            border-radius: 8px;
            padding: 20px;
            z-index: 100;
            margin-top: 10px;
            animation: fadeIn 0.3s;
        }

        .dropdown-content.show {
            display: block;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            margin: 0 auto 15px;
            display: block;
        }

        .profile-name {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            background-color: black;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: rgba(214, 153, 40, 0.932);
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--accent-color);
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        .dashboard-content {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            width: 200px;
            padding: 15px;
            font-size: 1.1em;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .dropdown-content {
                position: fixed;
                left: 50%;
                transform: translateX(-50%);
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="dropdown">
            <button class="dropbtn">Mon Profil</button>
            <div class="dropdown-content" id="userInfo">
                <?php if (!empty($utilisateur['image']) && file_exists('uploads/' . $utilisateur['image'])): ?>
                    <img src="uploads/<?= htmlspecialchars($utilisateur['image']) ?>" 
                         alt="Photo de profil" 
                         class="profile-image">
                <?php else: ?>
                    <img src="images/default-profile.png" 
                         alt="Photo de profil par défaut" 
                         class="profile-image">
                <?php endif; ?>

                <h3 class="profile-name">
                    <?= htmlspecialchars($utilisateur['nom']) . ' ' . htmlspecialchars($utilisateur['prenoms']) ?>
                </h3>
                
                <a href="modifp.php" class="btn">Modifier le profil</a>
                <a href="deconnection.php" class="btn btn-danger">Déconnexion</a>
            </div>
        </div>
    </header>

    <main class="dashboard-content">
        <div class="action-buttons">
            <a href="reservation.php" class="btn">Faire une réservation</a>
            <a href="mesreservations.php" class="btn">Mes réservations</a>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropBtn = document.querySelector('.dropbtn');
            const dropdownContent = document.getElementById('userInfo');

            // Toggle du menu dropdown
            dropBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownContent.classList.toggle('show');
            });

            // Fermer le menu si on clique ailleurs
            document.addEventListener('click', function() {
                if (dropdownContent.classList.contains('show')) {
                    dropdownContent.classList.remove('show');
                }
            });

            // Empêcher la fermeture quand on clique dans le menu
            dropdownContent.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
</body>
</html>