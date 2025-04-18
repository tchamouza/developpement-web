<?php
// Connexion à la base de données
require '../config.php';

$errors = [];
$success = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et validation des données
    $nom = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validation
    if (empty($nom)) {
        $errors[] = "Le nom est obligatoire";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Veuillez entrer une adresse email valide";
    }
    
    if (empty($message)) {
        $errors[] = "Le message ne peut pas être vide";
    }

    // Enregistrement en base si pas d'erreurs
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (nom, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $email, $message]);
            
            $success = "Votre message a bien été envoyé. Nous vous contacterons bientôt!";
            
            // Réinitialisation des champs après envoi réussi
            $_POST = [];
        } catch (PDOException $e) {
            $errors[] = "Une erreur est survenue lors de l'envoi du message. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="../avion (1).png">
  <title>Contact</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../contact style.css">
</head>

<body>
  <header>
    <div class="logo">
    <img src="../avion (1).png" alt="Logo du site" width="30px" height="30px" >

      <a href="#">airline<span>TRAVEL</span></a>
    </div>
    <nav>
      <ul>
        <li><a href="../index.html">Accueil</a></li>
        <li><a href="Service.html">Services</a></li>
        <li><a href="../connexion.php">Connexion</a></li>
        <li><a href="Contact.html">Contact</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <br><br><br>
    <h1>Contactez-nous</h1>
    <p>
      Voulez-vous nous contacter ? Réserver ?<br>
      Remplissez le formulaire ci-dessous, et nous vous répondrons dès que possible.
    </p>
  </section>

  <?php if (!empty($errors)): ?>
    <div style="color: red; text-align: center; margin: 20px auto; max-width: 600px; padding: 10px; background: #ffebee; border-left: 4px solid #c62828;">
      <?php foreach ($errors as $error): ?>
        <p><?= $error ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($success)): ?>
    <div style="color: green; text-align: center; margin: 20px auto; max-width: 600px; padding: 10px; background: #e8f5e9; border-left: 4px solid #2e7d32;">
      <p><?= $success ?></p>
    </div>
  <?php endif; ?>

  <section class="contact-form">
    <form action="" method="post">
      <label for="name">Nom :</label>
      <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>

      <label for="email">Email :</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

      <label for="message">Message :</label>
      <textarea id="message" name="message" rows="7" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>

      <button type="submit">Envoyer</button>
    </form>
  </section>

  <footer>
    <div class="logo">
      <p>© copyright @ 2025 par <a href="#" style="font-size: 20px;">airline<span
            style="font-size: 25px;">TRAVEL</span></a>. Tous droits réservés.</p>
    </div>
    <p>📍 Adresse : Lomé-Togo</p>
    <p>📞 <a href="tel:+22892558895" style="color: white; text-decoration: none;">+228 92 58 88 95</a></p>
    <p>📧 <a href="mailto:contact@airlinetravel.tg"
        style="color: white; text-decoration: none;">contact@airlinetravel.tg</a></p>
  </footer>
</body>
</html>