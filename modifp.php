<?php
require 'config.php';
session_start();

// Vérification de la session
if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit();
}

$errors = [];
$success = '';
$password_errors = [];
$password_success = '';

// Récupération des données actuelles
$utilisateur_id = $_SESSION['utilisateur']['id'];
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$utilisateur_id]);
$utilisateur = $stmt->fetch();

// Traitement du formulaire de modification de profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si c'est une demande de changement de mot de passe
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validation du mot de passe
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            $password_errors[] = 'Tous les champs sont obligatoires';
        } elseif ($new_password !== $confirm_password) {
            $password_errors[] = 'Les nouveaux mots de passe ne correspondent pas';
        } elseif (strlen($new_password) < 4 || strlen($new_password) > 8) {
            $password_errors[] = 'Le mot de passe doit contenir entre 4 et 8 caractères';
        } elseif (!password_verify($current_password, $utilisateur['motdepasse'])) {
            $password_errors[] = 'Mot de passe actuel incorrect';
        }

        // Mise à jour du mot de passe
        if (empty($password_errors)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE utilisateurs SET motdepasse = ? WHERE id = ?");

            if ($stmt->execute([$hashed_password, $utilisateur_id])) {
                $password_success = 'Mot de passe changé avec succès';
            } else {
                $password_errors[] = 'Erreur lors de la mise à jour du mot de passe';
            }
        }
    } else {
        // Traitement des autres modifications de profil
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenoms = htmlspecialchars(trim($_POST['prenoms']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $date_naissance = htmlspecialchars(trim($_POST['date_naissance']));
        $telephone = htmlspecialchars(trim($_POST['telephone']));

        // Validation des champs
        $required_fields = [
            'nom' => $nom,
            'prenoms' => $prenoms,
            'email' => $email,
            'date_naissance' => $date_naissance,
            'telephone' => $telephone
        ];

        foreach ($required_fields as $field => $value) {
            if (empty($value)) {
                $errors[] = "Le champ " . ucfirst($field) . " est obligatoire";
            }
        }

        // Validation email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format d'email invalide";
        }

        // Vérification unicité email
        if (empty($errors)) {
            $checkEmail = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ? AND id != ?");
            $checkEmail->execute([$email, $utilisateur_id]);
            if ($checkEmail->fetch()) {
                $errors[] = "Cet email est déjà utilisé par un autre compte";
            }
        }

        // Gestion de l'image
        $image_name = $utilisateur['image'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $max_size = 2 * 1024 * 1024; // 2Mo

            if (!in_array($_FILES['image']['type'], $allowed_types)) {
                $errors[] = "Type d'image non supporté (JPEG, PNG, GIF, WebP seulement)";
            } elseif ($_FILES['image']['size'] > $max_size) {
                $errors[] = "L'image ne doit pas dépasser 2Mo";
            } else {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $image_name = 'profile_' . uniqid() . '.' . $ext;
                $target_path = 'uploads/' . $image_name;

                if (!file_exists('uploads')) {
                    mkdir('uploads', 0755, true);
                }

                // Suppression ancienne image
                if (!empty($utilisateur['image']) && file_exists('uploads/' . $utilisateur['image'])) {
                    unlink('uploads/' . $utilisateur['image']);
                }

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                    $errors[] = "Erreur lors du téléchargement de l'image";
                    $image_name = $utilisateur['image'];
                }
            }
        }

        // Mise à jour si aucune erreur
        if (empty($errors)) {
            try {
                $pdo->beginTransaction();

                $sql = "UPDATE utilisateurs SET 
                        nom = ?, 
                        prenoms = ?, 
                        email = ?, 
                        age = ?, 
                        telephone = ?, 
                        image = ?
                        WHERE id = ?";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $nom,
                    $prenoms,
                    $email,
                    $date_naissance,
                    $telephone,
                    $image_name,
                    $utilisateur_id
                ]);

                // Mise à jour des données de session
                $_SESSION['utilisateur']['nom'] = $nom;
                $_SESSION['utilisateur']['prenoms'] = $prenoms;
                $_SESSION['utilisateur']['email'] = $email;
                $_SESSION['utilisateur']['image'] = $image_name;

                $pdo->commit();
                $success = "Profil mis à jour avec succès";

                // Rafraîchir les données
                $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
                $stmt->execute([$utilisateur_id]);
                $utilisateur = $stmt->fetch();
            } catch (PDOException $e) {
                $pdo->rollBack();
                $errors[] = "Erreur lors de la mise à jour : " . $e->getMessage();
            }
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
    <title>Modifier Profil - Airline Travel</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h2 {
            color: midnightblue;
            border-bottom: 2px solid midnightblue;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;

        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .current-image {
            margin: 15px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .current-image img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid midnightblue;
        }

        .btn-submit {
            background: black;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background:rgba(214, 153, 40, 0.932);
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-error {
            background: #ffebee;
            color: #c62828;
            border-left: 4px solid #c62828;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border-left: 4px solid #2e7d32;
        }
        nav.navigation{
            width: 50%;
            margin-left:50%;
            display: inline;
            padding:10px 0;
          
        }
        nav.navigation a{
          
            text-decoration:none;
            border:10px;
            color:white;
             padding:10px;
            font-family: arial;
            border-radius: 10px;
        }
        nav.navigation a:hover{
               background-color:rgba(214, 153, 40, 0.932);
        }
 label {
    display: block;
    margin-bottom: 5px;
    font-size: 1rem;
    color: #555;
}
 input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.3s ease;
}

 input:focus {
    border-color: black;
}

    </style>
</head>

<body>
<header>
    <nav class="navigation">
    <a href="./dashbord.php">Tableau de bord</a>
    <a href="deconnection.php">Déconnexion</a>
    </nav>
</header>

    <div class="form-container">
        <h1 style="color: midnightblue; text-align: center;">Modifier mon profil</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <p><?= htmlspecialchars($success) ?></p>
            </div>
        <?php endif; ?>

        <div class="form-section">
            <h2>Informations personnelles</h2>
            <form method="POST" enctype="multipart/form-data" autocomplete="off" action="">
                <div class="form-group">
                    <?php if (!empty($utilisateur['image']) && file_exists('uploads/' . $utilisateur['image'])): ?>
                        <div class="current-image">
                            <span>Profil actuelle :</span>
                            <img src="uploads/<?= htmlspecialchars($utilisateur['image']) ?>" alt="Photo de profil">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="prenoms">Prénoms</label>
                    <input type="text" id="prenoms" name="prenoms" value="<?= htmlspecialchars($utilisateur['prenoms']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="<?= htmlspecialchars($utilisateur['age']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($utilisateur['telephone']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="image">Photo de profil</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <?php if (!empty($utilisateur['image']) && file_exists('uploads/' . $utilisateur['image'])): ?>
                    <?php endif; ?>
                </div>

                <div style="text-align: center; margin-top: 25px;">
                    <button type="submit" class="btn-submit">Enregistrer les modifications</button>
                </div>
            </form>
        </div>

        <div class="form-section">
            <h2>Changer le mot de passe</h2>

            <?php if (!empty($password_errors)): ?>
                <div class="alert alert-error">
                    <?php foreach ($password_errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($password_success)): ?>
                <div class="alert alert-success">
                    <p><?= htmlspecialchars($password_success) ?></p>
                </div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="change_password" value="1">

                <div class="form-group">
                    <label for="current_password">Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password">Nouveau mot de passe (4-8 caractères)</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmer le nouveau mot de passe</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div style="text-align: center; margin-top: 25px;">
                    <button type="submit" class="btn-submit">Changer le mot de passe</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>