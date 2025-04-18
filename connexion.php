<?php
require 'config.php';
session_start();

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $motdepasse = $_POST['motdepasse'];

    if (empty($email) || empty($motdepasse)) {
        $errors[] = 'Veuillez remplir tous les champs.';
    } else {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($motdepasse, $utilisateur['motdepasse'])) {
            $_SESSION['utilisateur'] = $utilisateur;
            header('Location: ./dashbord.php');
            exit();
        } else {
            $errors[] = "Email ou mot de passe incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="avion (1).png">
    <link rel="stylesheet" href="./style.css">
    <title>Connexion</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="avion (1).png" alt="Logo du site" width="30px" height="30px">

            <a href="#">airline<span>TRAVEL</span></a>
        </div>
        <nav>
            <ul>
                <li><a href="./index.html">Accueil</a></li>
                <li><a href="./pages/Service.html">Services</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="./pages/Contact.php">Contact</a></li>
                <li><a href="A-propos.html">À propos</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <form action="" class="reservation" method="POST" autocomplete="off">
            <h1 style="color: midnightblue;">Connexion</h1>

            <?php if (!empty($errors)): ?>
                <div style="color: red;"><?= implode('<br>', $errors) ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div style="color: green;"><?= $success ?></div>
            <?php endif; ?>

            <label for="email">Email<span>*</span></label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" required>

            <label for="motdepasse">Mot de passe<span>*</span></label>
            <input type="password" id="motdepasse" name="motdepasse" placeholder="Entrez votre mot de passe" required>
            <br><br>

            <p style="font-family: century; text-align:center;">
                Pas de compte ?
                <a style="text-decoration: none; color:midnightblue" href="./inscription.php">Inscrivez-vous</a>
            </p><br>

            <button type="submit">Connexion</button>
        </form>
    </section>
    <footer>
        <div class="logo">
            <p>© copyright @ 2025 par <a href="#" style="font-size: 20px;">airline<span style="font-size: 25px;">TRAVEL</span></a>. Tous droits réservés.</p>
        </div>
        <p>📍 Adresse : Lomé-Togo</p>
        <p>📞 <a href="tel:+22892558895" style="color: white; text-decoration: none;">+228 92 58 88 95</a></p>
        <p>📧 <a href="mailto:contact@airlinetravel.tg" style="color: white; text-decoration: none;">contact@airlinetravel.tg</a></p>
    </footer>
</body>

</html>