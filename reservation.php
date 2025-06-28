<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'controllers/ReservationController.php';
    $reservationController = new ReservationController();
    $reservationController->create();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="avion (1).png">
    <title>Réservation</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
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
                <li><a href="dashboard.php">Tableau de bord</a></li>
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
                <li><a href="dashboard.php">Tableau de bord</a></li>
                <li><a href="pages/Contact.php">Contact</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </div>
    </header>

    <section>
        <?php if (isset($_SESSION['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin: 20px; border-radius: 5px; text-align: center;">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="reservation.php" class="reservation" method="POST" autocomplete="off">
            <h1>Nouvelle Réservation</h1>

            <label for="destination">Destination<span>*</span></label>
            <select id="destination" name="destination" required>
                <option value="">Choisissez une destination</option>
                <option value="France">France</option>
                <option value="Japon">Japon</option>
                <option value="Égypte">Égypte</option>
                <option value="Brésil">Brésil</option>
                <option value="Italie">Italie</option>
                <option value="Jamaïque">Jamaïque</option>
                <option value="Grèce">Grèce</option>
                <option value="Maldives">Maldives</option>
                <option value="Thaïlande">Thaïlande</option>
                <option value="Autre">Autre</option>
            </select>

            <label for="date_depart">Date de départ<span>*</span></label>
            <input type="date" id="date_depart" name="date_depart" required min="<?php echo date('Y-m-d'); ?>">

            <label for="date_retour">Date de retour<span>*</span></label>
            <input type="date" id="date_retour" name="date_retour" required min="<?php echo date('Y-m-d'); ?>">

            <label for="nombre_personnes">Nombre de personnes<span>*</span></label>
            <select id="nombre_personnes" name="nombre_personnes" required>
                <option value="">Sélectionnez</option>
                <option value="1">1 personne</option>
                <option value="2">2 personnes</option>
                <option value="3">3 personnes</option>
                <option value="4">4 personnes</option>
                <option value="5">5 personnes</option>
                <option value="6+">6 personnes ou plus</option>
            </select>

            <label for="type_voyage">Type de voyage<span>*</span></label>
            <select id="type_voyage" name="type_voyage" required>
                <option value="">Choisissez le type</option>
                <option value="Détente/Plage">Détente/Plage</option>
                <option value="Aventure/Montagne">Aventure/Montagne</option>
                <option value="Culturel/Ville">Culturel/Ville</option>
                <option value="Romantique">Romantique</option>
                <option value="Familial">Familial</option>
                <option value="Affaires">Affaires</option>
            </select>

            <label for="budget">Budget approximatif (€)<span>*</span></label>
            <select id="budget" name="budget" required>
                <option value="">Sélectionnez votre budget</option>
                <option value="500">Moins de 500€</option>
                <option value="1000">500€ - 1000€</option>
                <option value="2000">1000€ - 2000€</option>
                <option value="3000">2000€ - 3000€</option>
                <option value="5000">3000€ - 5000€</option>
                <option value="5001">Plus de 5000€</option>
            </select>

            <button type="submit">Réserver</button>
        </form>
    </section>

    <footer>
        <div class="logo">
            <br>
            <p>© copyright @ 2025 par <a href="#">airline<span>TRAVEL</span></a>. Tous droits réservés.</p>
        </div>
        <p>📍 Adresse : Lomé-Togo</p>
        <p>📞 <a href="tel:+22892558895" style="color: gray;text-decoration: none;">Telephone</a></p>
        <p>📧 <a href="mailto:contact@airlinetravel.tg" style="color: gray;text-decoration: none;">contact@airlinetravel.tg</a></p>
    </footer>

    <script>
        // Validation des dates
        document.getElementById('date_depart').addEventListener('change', function() {
            const dateDepart = new Date(this.value);
            const dateRetour = document.getElementById('date_retour');
            
            // La date de retour doit être au moins le jour suivant
            const minRetour = new Date(dateDepart);
            minRetour.setDate(minRetour.getDate() + 1);
            
            dateRetour.min = minRetour.toISOString().split('T')[0];
            
            // Si la date de retour est antérieure, la réinitialiser
            if (dateRetour.value && new Date(dateRetour.value) <= dateDepart) {
                dateRetour.value = '';
            }
        });
    </script>
</body>
</html>