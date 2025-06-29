<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'airlineTRAVEL' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="/public/css/style.css" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-black border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center">
                            <a href="/" class="text-white text-xl font-bold">
                                airline<span class="text-yellow-500 text-2xl">TRAVEL</span>
                            </a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="/" class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/home') ? 'active' : '' ?>">Accueil</a>
                            <a href="/services" class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/services') ? 'active' : '' ?>">Services</a>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="/dashboard" class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/dashboard') ? 'active' : '' ?>">Tableau de bord</a>
                                <a href="/reservations/create" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/reservations') !== false) ? 'active' : '' ?>">Réserver</a>
                            <?php endif; ?>
                            <a href="/contact" class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/contact') ? 'active' : '' ?>">Contact</a>
                            <a href="/about" class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/about') ? 'active' : '' ?>">À propos</a>
                        </div>
                    </div>
                    
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="relative">
                                <span class="text-white mr-4">Bonjour, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                                <a href="/logout" class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">Déconnexion</a>
                            </div>
                        <?php else: ?>
                            <div class="space-x-4">
                                <a href="/login" class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
                                <a href="/register" class="bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-2 rounded-md text-sm font-medium">Inscription</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Messages flash -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mx-4 mt-4 alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-4 mt-4 alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Contenu principal -->
        <main>
            <?= $content ?>
        </main>
    </div>
    
    <script src="/public/js/app.js"></script>
</body>
</html>