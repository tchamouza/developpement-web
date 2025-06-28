<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="avion (1).png">
    <title>Accueil - airlineTRAVEL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <li><a href="dashboard.php">Tableau de bord</a></li>
            <li><a href="reservation.php">Réserver</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
          <?php else: ?>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="inscription.php">Inscription</a></li>
          <?php endif; ?>
          <li><a href="pages/Contact.php">Contact</a></li>
          <li><a href="A-propos.php">À propos</a></li>
        </ul>
      </nav>

      <!-- Menu Burger pour mobile -->
      <div class="menu-toggle" id="mobile-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <!-- Navigation mobile (popup) -->
      <div class="mobile-nav" id="mobile-nav">
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="pages/Service.php">Services</a></li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <li><a href="dashboard.php">Tableau de bord</a></li>
            <li><a href="reservation.php">Réserver</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
          <?php else: ?>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="inscription.php">Inscription</a></li>
          <?php endif; ?>
          <li><a href="pages/Contact.php">Contact</a></li>
          <li><a href="A-propos.php">À propos</a></li>
        </ul>
      </div>
    </header>

    <section class="titre">
      <br><br><br><br><br><br>
      <h2>Bienvenue sur airlineTRAVEL</h2>
      <p>Vous voulez voyager en toute sécurité et aisance ? Vous êtes à la bonne adresse.</p>

      <div class="bouton">
        <a href="pages/Service.php" class="btn">Découvrir</a>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
          <a href="dashboard.php" class="btn">Mon espace</a>
        <?php else: ?>
          <a href="connexion.php" class="btn">Se connecter</a>
        <?php endif; ?>
      </div><br><br><br><br><br><br>
    </section>

    <footer>
      <div class="logo">
        <br>
        <p>© copyright @ 2025 par <a href="#">airline<span>TRAVEL</span></a>.
          Tous droits réservés.</p>
      </div>
      <p>📍 Adresse : Lomé-Togo</p>
      <p>📞 <a href="tel:+22892558895"
          style="color: gray;text-decoration: none;">Telephone</a></p>
      <p>📧 <a href="mailto:contact@airlinetravel.tg"
          style="color: gray;text-decoration: none;">contact@airlinetravel.tg</a></p>
    </footer>

  </body>

</html>