<?php 
$title = 'Contact - airlineTRAVEL';
ob_start(); 
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Contactez-nous</h1>
        <p class="text-xl md:text-2xl">
            Voulez-vous nous contacter ? Réserver ?<br>
            Remplissez le formulaire ci-dessous, et nous vous répondrons dès que possible.
        </p>
    </div>
</section>

<!-- Formulaire de contact -->
<section class="py-16 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="/contact">
                <!-- Nom -->
                <div class="mb-6">
                    <label for="nom" class="block font-medium text-sm text-gray-700">Nom</label>
                    <input id="nom" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="text" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required autofocus>
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                    <input id="email" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <label for="message" class="block font-medium text-sm text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="6" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Informations de contact -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6">
                <div class="text-4xl mb-4">📍</div>
                <h3 class="text-xl font-semibold mb-2">Adresse</h3>
                <p class="text-gray-600">Lomé-Togo</p>
            </div>
            <div class="p-6">
                <div class="text-4xl mb-4">📞</div>
                <h3 class="text-xl font-semibold mb-2">Téléphone</h3>
                <p class="text-gray-600">
                    <a href="tel:+22892558895" class="hover:text-yellow-600">+228 92 55 88 95</a>
                </p>
            </div>
            <div class="p-6">
                <div class="text-4xl mb-4">📧</div>
                <h3 class="text-xl font-semibold mb-2">Email</h3>
                <p class="text-gray-600">
                    <a href="mailto:contact@airlinetravel.tg" class="hover:text-yellow-600">contact@airlinetravel.tg</a>
                </p>
            </div>
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