<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../controllers/ContactController.php';
    $contactController = new ContactController();
    $contactController->create();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="../avion (1).png">
    <title>Contact</title>
    <meta name="description" content>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../contact styles.css">
    <link rel="stylesheet" href="../style.css">
    <script src="../scripts.js" defer></script>

  </head>

  <body>
    <header>
      <div class="logo">
        <img src="../avion (1).png" alt="Logo du site" width="30px"
          height="30px">

        <a href="#">airline<span>TRAVEL</span></a>
      </div>
      <nav>
        <ul>
          <li><a href="../index.php">Accueil</a></li>
          <li><a href="Service.php">Services</a></li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <li><a href="../dashboard.php">Tableau de bord</a></li>
            <li><a href="../logout.php">Déconnexion</a></li>
          <?php else: ?>
            <li><a href="../connexion.php">Connexion</a></li>
          <?php endif; ?>
          <li><a href="#">Contact</a></li>
          <li><a href="../A-propos.php">À propos</a></li>
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
          <li><a href="../index.php">Accueil</a></li>
          <li><a href="Service.php">Services</a></li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <li><a href="../dashboard.php">Tableau de bord</a></li>
            <li><a href="../logout.php">Déconnexion</a></li>
          <?php else: ?>
            <li><a href="../connexion.php">Connexion</a></li>
          <?php endif; ?>
          <li><a href="Contact.php">Contact</a></li>
          <li><a href="../A-propos.php">À propos</a></li>
        </ul>
      </div>
    </header>

    <section class="hero">
      <br><br><br>
      <h1>Contactez-nous</h1>
      <p>
        Voulez-vous nous contacter ? Réserver ?<br>
        Remplissez le formulaire ci-dessous, et nous vous répondrons dès que
        possible.
      </p>
    </section>

    <?php if (isset($_SESSION['success'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin: 20px; border-radius: 5px; text-align: center;">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin: 20px; border-radius: 5px; text-align: center;">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <section class="contact-form">
      <form action="Contact.php" method="post">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="7" required></textarea>

        <button type="submit">Envoyer</button>
      </form>
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