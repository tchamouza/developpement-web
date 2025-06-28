<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'controllers/AuthController.php';
    $authController = new AuthController();
    $authController->login();
}
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="avion (1).png">
        <link rel="stylesheet" href="style.css">
        <script src="scripts.js"></script>
        <title>Connexion</title>
    </head>

    <body>
        <header>
            <div class="logo">
                <img src="avion (1).png" alt="Logo du site" width="30px"
                    height="30px">

                <a href="#">airline<span>TRAVEL</span></a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="pages/Service.php">Services</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
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
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="pages/Contact.php">Contact</a></li>
                    <li><a href="A-propos.php">À propos</a></li>
                </ul>
            </div>
        </header>

        <section>
            <?php if (isset($_SESSION['error'])): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin: 20px; border-radius: 5px; text-align: center;">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div style="background-color: #d4edda; color: #155724; padding: 10px; margin: 20px; border-radius: 5px; text-align: center;">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form action="connexion.php" class="reservation" method="POST" autocomplete="off">
                <h1>Connexion</h1>

                <label for="email">Email<span>*</span></label>
                <input type="email" id="email" name="email"
                    placeholder="Entrez votre email" required>

                <label for="motdepasse">Mot de passe<span>*</span></label>
                <input type="password" id="motdepasse" name="motdepasse"
                    placeholder="Entrez votre mot de passe" required>
                <br><br>

                <p style="font-family: century; text-align:center;">
                    Pas de compte ?
                    <a style="text-decoration: none; color:midnightblue"
                        href="inscription.php">Inscrivez-vous</a>
                </p><br>

                <button type="submit">Connexion</button>
            </form>
        </section>
        <footer>
            <div class="logo">
                <br>
                <p>© copyright @ 2025 par <a
                        href="#">airline<span>TRAVEL</span></a>. Tous droits
                    réservés.</p>
            </div>
            <p>📍 Adresse : Lomé-Togo</p>
            <p>📞 <a href="tel:+22892558895"
                    style="color: gray;text-decoration: none;">Telephone</a></p>
            <p>📧 <a href="mailto:contact@airlinetravel.tg"
                    style="color: gray;text-decoration: none;">contact@airlinetravel.tg</a></p>
        </footer>
    </body>

</html>