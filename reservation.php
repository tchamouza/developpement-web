<?php
require 'config.php';
session_start();

if (!isset($_SESSION['utilisateur'])) {
  header('Location: connexion.php');
  exit;
}

$utilisateur = $_SESSION['utilisateur'];
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $numerodevol = 'FLIGHT' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $departure = htmlspecialchars($_POST['departure']);
  $arrival = htmlspecialchars($_POST['arrival']);
  $date = htmlspecialchars($_POST['date']);
  $tarif = htmlspecialchars($_POST['tarif']);

  if (empty($name) || empty($email) || empty($phone) || empty($departure) || empty($arrival) || empty($date) || empty($tarif)) {
    $errors[] = 'Tous les champs sont obligatoires.';
  }

  if (empty($errors)) {
    $sql = "INSERT INTO reservation (numerodevol, name, email, phone, depart, arrive, date, tarif)
            VALUES (:numerodevol, :name, :email, :phone, :departure, :arrival, :date, :tarif)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':numerodevol', $numerodevol);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':departure', $departure);
    $stmt->bindParam(':arrival', $arrival);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':tarif', $tarif);

    try {
      if ($stmt->execute()) {
        header('Location: confirmationvol.php');
        exit();
      }
    } catch (PDOException $e) {
      $errors[] = "Erreur lors de la réservation : " . $e->getMessage();
    }
  }
  }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="avion (1).png">
  <title>Réservation de vol</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>

  <section>
    <form class="reservation" action="" method="POST" autocomplete="off">
      <h1 style="color: midnightblue;">Réservation de Vol</h1>

      <?php if (!empty($errors)): ?>
        <p style="color:red"><?= implode('<br>', $errors) ?></p>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <p style="color:green"><?= $success ?></p>
      <?php endif; ?>

      <label for="name">Nom<span>*</span></label>
      <input type="text" id="name" name="name" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>

      <label for="email">Email<span>*</span></label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>

      <label for="phone">Téléphone<span>*</span></label>
      <input type="tel" id="phone" name="phone" placeholder="Votre numéro" required>

      <label for="departure">Lieu de départ<span>*</span></label>
      <input type="text" id="departure" name="departure" required>

      <label for="arrival">Lieu d'arrivée<span>*</span></label>
      <input type="text" id="arrival" name="arrival" required>

      <label for="date">Date de départ<span>*</span></label>
      <input type="date" id="date" name="date" required>

      <label for="tarif">Tarif (€)<span>*</span></label>
      <input type="text" id="tarif" name="tarif" required>

      <button type="submit">Réserver</button>
    </form>
  </section>

  <script src="scripts.js"></script>
</body>

</html>