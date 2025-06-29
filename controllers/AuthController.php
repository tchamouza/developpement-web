<?php
class AuthController {
    public function showLogin() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }
        include 'views/auth/login.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs.';
            header('Location: /login');
            exit;
        }
        
        $userModel = new User();
        $user = $userModel->findByEmail($email);
        
        if ($user && $userModel->verifyPassword($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $userModel->getFullName($user);
            $_SESSION['success'] = 'Connexion réussie !';
            header('Location: /dashboard');
        } else {
            $_SESSION['error'] = 'Email ou mot de passe incorrect.';
            header('Location: /login');
        }
        exit;
    }
    
    public function showRegister() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }
        include 'views/auth/register.php';
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }
        
        $data = [
            'nom' => $_POST['nom'] ?? '',
            'prenoms' => $_POST['prenoms'] ?? '',
            'date_naissance' => $_POST['date_naissance'] ?? '',
            'email' => $_POST['email'] ?? '',
            'telephone' => $_POST['telephone'] ?? '',
            'password' => $_POST['password'] ?? '',
            'password_confirmation' => $_POST['password_confirmation'] ?? ''
        ];
        
        // Validation simple
        if (empty($data['nom']) || empty($data['prenoms']) || empty($data['email']) || empty($data['password'])) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires.';
            header('Location: /register');
            exit;
        }
        
        if ($data['password'] !== $data['password_confirmation']) {
            $_SESSION['error'] = 'Les mots de passe ne correspondent pas.';
            header('Location: /register');
            exit;
        }
        
        // Gestion de l'upload de photo
        $photoPath = null;
        if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'public/images/profiles/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileName = uniqid() . '_' . $_FILES['photo_profil']['name'];
            $photoPath = $uploadDir . $fileName;
            
            if (!move_uploaded_file($_FILES['photo_profil']['tmp_name'], $photoPath)) {
                $photoPath = null;
            }
        }
        
        $data['photo_profil'] = $photoPath;
        
        $userModel = new User();
        
        // Vérifier si l'email existe déjà
        if ($userModel->findByEmail($data['email'])) {
            $_SESSION['error'] = 'Cet email est déjà utilisé.';
            header('Location: /register');
            exit;
        }
        
        if ($userModel->create($data)) {
            $user = $userModel->findByEmail($data['email']);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $userModel->getFullName($user);
            $_SESSION['success'] = 'Inscription réussie !';
            header('Location: /dashboard');
        } else {
            $_SESSION['error'] = 'Erreur lors de l\'inscription.';
            header('Location: /register');
        }
        exit;
    }
    
    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}
?>