<?php 
$title = 'Services - airlineTRAVEL';
ob_start(); 
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos Services</h1>
        <p class="text-xl md:text-2xl">Créez votre séjour de rêve avec airlineTRAVEL</p>
    </div>
</section>

<!-- Description des services -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://images.pexels.com/photos/1008155/pexels-photo-1008155.jpeg" alt="Travel" class="w-full rounded-lg shadow-lg">
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-6">Créer votre séjour avec airlineTRAVEL</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Le but ultime des vacances, c'est sans conteste de s'offrir un pur moment de détente… et rien d'autre. 
                    Pour pousser la zénitude à son paroxysme, laissez-vous tenter par un séjour tout compris! 
                    Repas, en-cas, cocktails et boissons en tout genre, activités sympas, spa… tout est imaginé pour 
                    répondre à vos besoins du moment où vous sortez du lit jusqu'à ce que vous tombiez dans les bras de Morphée. 
                    Ajoutez-y une formule hôtel et vol, et il ne vous reste plus qu'à profiter. Elle n'est pas belle, la vie?
                </p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/reservations/create" class="bg-yellow-500 text-black px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300 inline-block">
                        Réserver maintenant
                    </a>
                <?php else: ?>
                    <a href="/login" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition duration-300 inline-block">
                        Se connecter pour réserver
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Destinations populaires -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Destinations Populaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($destinations as $destination): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 group">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/2034335/pexels-photo-2034335.jpeg" alt="<?= htmlspecialchars($destination['nom']) ?>" class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <div class="text-white text-center">
                            <h4 class="text-xl font-bold mb-2"><?= htmlspecialchars($destination['nom']) ?></h4>
                            <p class="text-sm"><?= htmlspecialchars($destination['pays']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($destination['nom']) ?></h3>
                    <p class="text-gray-600 mb-4"><?= htmlspecialchars($destination['description']) ?></p>
                    <?php if ($destination['prix_base']): ?>
                        <p class="text-lg font-bold text-yellow-600 mb-4">À partir de <?= number_format($destination['prix_base'], 0, ',', ' ') ?>€</p>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="/reservations/create" class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600 transition duration-300 w-full block text-center">
                            Réserver
                        </a>
                    <?php else: ?>
                        <a href="/login" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300 w-full block text-center">
                            Se connecter
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

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