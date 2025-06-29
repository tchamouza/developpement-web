<?php 
$title = 'Accueil - airlineTRAVEL';
ob_start(); 
?>

<!-- Hero Section -->
<section class="relative h-screen bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/1008155/pexels-photo-1008155.jpeg');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 text-yellow-500">
                Bienvenue sur airlineTRAVEL
            </h1>
            <p class="text-xl md:text-2xl mb-8">
                Vous voulez voyager en toute sécurité et aisance ? Vous êtes à la bonne adresse.
            </p>
            <div class="space-x-4">
                <a href="/services" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-black transition duration-300">
                    Découvrir
                </a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/dashboard" class="bg-yellow-500 text-black px-8 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                        Mon espace
                    </a>
                <?php else: ?>
                    <a href="/login" class="bg-yellow-500 text-black px-8 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                        Se connecter
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Destinations populaires -->
<?php if (!empty($destinations)): ?>
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Destinations Populaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($destinations as $destination): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <img src="https://images.pexels.com/photos/2034335/pexels-photo-2034335.jpeg" alt="<?= htmlspecialchars($destination['nom']) ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($destination['nom']) ?></h3>
                    <p class="text-gray-600 mb-4"><?= htmlspecialchars($destination['description']) ?></p>
                    <?php if ($destination['prix_base']): ?>
                        <p class="text-lg font-bold text-yellow-600 mb-4">À partir de <?= number_format($destination['prix_base'], 0, ',', ' ') ?>€</p>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="/reservations/create" class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">
                            Réserver
                        </a>
                    <?php else: ?>
                        <a href="/login" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">
                            Se connecter pour réserver
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Footer -->
<footer class="bg-gray-200 text-gray-600 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-4">
            <p>© copyright @ 2025 par <a href="#" class="text-yellow-600 font-bold">airline<span class="text-yellow-500">TRAVEL</span></a>. Tous droits réservés.</p>
        </div>
        <div class="space-y-2">
            <p>📍 Adresse : Lomé-Togo</p>
            <p>📞 <a href="tel:+22892558895" class="hover:text-gray-800">Téléphone</a></p>
            <p>📧 <a href="mailto:contact@airlinetravel.tg" class="hover:text-gray-800">contact@airlinetravel.tg</a></p>
        </div>
    </div>
</footer>

<?php 
$content = ob_get_clean();
include 'layout.php';
?>