<?php 
$title = 'Inscription - airlineTRAVEL';
ob_start(); 
?>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <a href="/">
            <span class="text-3xl font-bold text-black">
                airline<span class="text-yellow-500">TRAVEL</span>
            </span>
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="/register" enctype="multipart/form-data">
            <h2 class="text-2xl font-bold text-center mb-6">Inscription</h2>

            <!-- Nom -->
            <div>
                <label for="nom" class="block font-medium text-sm text-gray-700">Nom</label>
                <input id="nom" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="text" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required autofocus>
            </div>

            <!-- Prénoms -->
            <div class="mt-4">
                <label for="prenoms" class="block font-medium text-sm text-gray-700">Prénoms</label>
                <input id="prenoms" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="text" name="prenoms" value="<?= htmlspecialchars($_POST['prenoms'] ?? '') ?>" required>
            </div>

            <!-- Date de naissance -->
            <div class="mt-4">
                <label for="date_naissance" class="block font-medium text-sm text-gray-700">Date de naissance</label>
                <input id="date_naissance" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="date" name="date_naissance" value="<?= htmlspecialchars($_POST['date_naissance'] ?? '') ?>" required>
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input id="email" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>

            <!-- Téléphone -->
            <div class="mt-4">
                <label for="telephone" class="block font-medium text-sm text-gray-700">Téléphone</label>
                <input id="telephone" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="tel" name="telephone" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>" required>
            </div>

            <!-- Photo de profil -->
            <div class="mt-4">
                <label for="photo_profil" class="block font-medium text-sm text-gray-700">Photo de profil</label>
                <input id="photo_profil" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="file" name="photo_profil" accept="image/*">
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Mot de passe</label>
                <input id="password" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="password" name="password" required>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmer le mot de passe</label>
                <input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="password" name="password_confirmation" required>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="/login">
                    Déjà inscrit ?
                </a>

                <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>
</div>

<?php 
$content = ob_get_clean();
echo $content;
?>