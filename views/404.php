<?php 
$title = 'Page non trouvée - airlineTRAVEL';
ob_start(); 
?>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Page non trouvée</h2>
        <p class="text-gray-600 mb-8">La page que vous recherchez n'existe pas.</p>
        <a href="/" class="bg-yellow-500 text-black px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
            Retour à l'accueil
        </a>
    </div>
</div>

<?php 
$content = ob_get_clean();
include 'layout.php';
?>