<?php
require_once 'config/database.php';
require_once 'models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Vérification des mots de passe
            if ($_POST['motdepasse'] !== $_POST['confirmemotdepasse']) {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                header("Location: inscription.php");
                return;
            }

            // Gestion de l'upload de photo
            $photo_profil = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = 'uploads/profiles/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $photo_profil = $upload_dir . uniqid() . '.' . $file_extension;
                
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $photo_profil)) {
                    $photo_profil = '';
                }
            }

            // Assignation des valeurs
            $this->user->nom = $_POST['name'];
            $this->user->prenoms = $_POST['prenoms'];
            $this->user->date_naissance = $_POST['date'];
            $this->user->email = $_POST['email'];
            $this->user->telephone = $_POST['phone'];
            $this->user->photo_profil = $photo_profil;
            $this->user->mot_de_passe = $_POST['motdepasse'];

            // Vérifier si l'email existe déjà
            if ($this->user->emailExists()) {
                $_SESSION['error'] = "Cet email est déjà utilisé.";
                header("Location: inscription.php");
                return;
            }

            // Créer l'utilisateur
            if ($this->user->create()) {
                $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                header("Location: connexion.php");
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription.";
                header("Location: inscription.php");
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['motdepasse'];

            if ($this->user->login($email, $password)) {
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['user_nom'] = $this->user->nom;
                $_SESSION['user_prenoms'] = $this->user->prenoms;
                $_SESSION['user_email'] = $this->user->email;
                $_SESSION['logged_in'] = true;

                header("Location: dashboard.php");
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: connexion.php");
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}
?>