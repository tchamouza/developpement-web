<?php

require 'config.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $nom = htmlspecialchars(trim($_POST['name']));
    $prenoms = htmlspecialchars(trim($_POST['prenoms']));
    $email = htmlspecialchars(trim($_POST['email']));
    $age = htmlspecialchars(trim($_POST['date']));
    $telephone = htmlspecialchars(trim($_POST['phone']));
    $motdepasse = $_POST['motdepasse'];
    $confirmemotdepasse = $_POST['confirmemotdepasse'];

    // Validation des champs requis
    if (
        empty($nom) || empty($prenoms) || empty($email) ||
        empty($age) || empty($telephone) || empty($motdepasse) || empty($confirmemotdepasse)
    ) {
        $errors[] = 'Saisissez toutes les informations demandées.';
    }

    if (strlen($motdepasse) > 8 || strlen($motdepasse) < 4) {
        $errors[] = 'Le mot de passe doit contenir entre 4 et 8 caractères.';
    } elseif ($motdepasse !== $confirmemotdepasse) {
        $errors[] = 'Les mots de passe ne correspondent pas.';
    }

    // Vérification de l'email en base
    if (empty($errors)) {
        $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
        $checkEmail->execute([$email]);
        if ($checkEmail->fetchColumn() > 0) {
            $errors[] = "Cet email est déjà enregistré.";
        }
    }

    // Traitement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_dir = 'uploads/' . $image_name;
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($image_ext, $allowed)) {
            $errors[] = "Le format de l'image n'est pas autorisé.";
        }

        if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
            $errors[] = "L'image est trop lourde (max 2 Mo).";
        }
    } else {
        $errors[] = "Erreur lors du téléchargement de l'image.";
    }

    // Enregistrement
    if (empty($errors)) {

        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        move_uploaded_file($image_tmp, $image_dir);

        $hachagemotdepasse = password_hash($motdepasse, PASSWORD_DEFAULT);

        $sql = "INSERT INTO utilisateurs (nom, prenoms, email, age, telephone, motdepasse, image)
                VALUES (:name, :prenoms, :email, :date, :phone, :motdepasse, :image)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $nom);
        $stmt->bindParam(':prenoms', $prenoms);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date', $age);
        $stmt->bindParam(':phone', $telephone);
        $stmt->bindParam(':motdepasse', $hachagemotdepasse);
        $stmt->bindParam(':image', $image_name);

        try {
            if ($stmt->execute()) {
                $success = 'Inscription réussie.';
            }
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de l'inscription : " . $e->getMessage();
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
    <title>Inscription</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: midnightblue;
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
                <li><a href="./index.html">Accueil</a></li>
                <li><a href="./pages/Service.html">Services</a></li>
                <li><a href="./connexion.php">Connexion</a></li>
                <li><a href="./pages/Contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <form action="" class="reservation" method="POST" enctype="multipart/form-data" autocomplete="off">
        <h1 style="color: midnightblue;">Inscription</h1>

        <?php if (!empty($errors)): ?>
            <p style="color:red"><?= implode('<br>', $errors) ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p style="color:green"><?= $success ?></p>
        <?php endif; ?>

        <label for="name">Nom<span>*</span></label>
        <input type="text" id="name" name="name" placeholder="Entrez votre nom" required>

        <label for="prenoms">Prénoms<span>*</span></label>
        <input type="text" id="prenoms" name="prenoms" placeholder="Entrez vos prénoms" required>

        <label for="date">Date de naissance<span>*</span></label>
        <input type="date" id="date" name="date" required>

        <label for="email">Email<span>*</span></label>
        <input type="email" id="email" name="email" placeholder="Entrez votre email" required>

        <label for="phone">Téléphone<span>*</span></label>
        <input type="tel" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone" required>

        <label for="image">Photo de profil<span>*</span></label>
        <input type="file" name="image" accept="image/*" id="image" required class="box">

        <label for="motdepasse">Mot de passe<span>*</span></label>
        <input type="password" id="motdepasse" name="motdepasse" placeholder="Entrez votre mot de passe" required>

        <label for="confirmemotdepasse">Confirmer mot de passe<span>*</span></label>
        <input type="password" id="confirmemotdepasse" name="confirmemotdepasse" placeholder="Confirmez votre mot de passe" required>

        <p style="font-family: century; text-align:center;">Vous avez fini l'inscription ?
            <a style="text-decoration: none; color:midnightblue" href="./connexion.php">Connectez-vous</a>
        </p><br>

        <button type="submit">Soumettre</button>
    </form>
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
    <script src="./scripts.js"></script>
</body>

</html>