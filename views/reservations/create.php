<?php 
$title = 'Nouvelle Réservation - airlineTRAVEL';
ob_start(); 
?>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">Nouvelle Réservation</h2>
                
                <form method="POST" action="/reservations/create">
                    <!-- Destination -->
                    <div class="mb-4">
                        <label for="destination" class="block font-medium text-sm text-gray-700">Destination</label>
                        <select id="destination" name="destination" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Choisissez une destination</option>
                            <option value="France">France</option>
                            <option value="Japon">Japon</option>
                            <option value="Égypte">Égypte</option>
                            <option value="Brésil">Brésil</option>
                            <option value="Italie">Italie</option>
                            <option value="Jamaïque">Jamaïque</option>
                            <option value="Grèce">Grèce</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Thaïlande">Thaïlande</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>

                    <!-- Date de départ -->
                    <div class="mb-4">
                        <label for="date_depart" class="block font-medium text-sm text-gray-700">Date de départ</label>
                        <input id="date_depart" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="date" name="date_depart" min="<?= date('Y-m-d') ?>" required>
                    </div>

                    <!-- Date de retour -->
                    <div class="mb-4">
                        <label for="date_retour" class="block font-medium text-sm text-gray-700">Date de retour</label>
                        <input id="date_retour" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" type="date" name="date_retour" min="<?= date('Y-m-d') ?>" required>
                    </div>

                    <!-- Nombre de personnes -->
                    <div class="mb-4">
                        <label for="nombre_personnes" class="block font-medium text-sm text-gray-700">Nombre de personnes</label>
                        <select id="nombre_personnes" name="nombre_personnes" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Sélectionnez</option>
                            <option value="1">1 personne</option>
                            <option value="2">2 personnes</option>
                            <option value="3">3 personnes</option>
                            <option value="4">4 personnes</option>
                            <option value="5">5 personnes</option>
                            <option value="6+">6 personnes ou plus</option>
                        </select>
                    </div>

                    <!-- Type de voyage -->
                    <div class="mb-4">
                        <label for="type_voyage" class="block font-medium text-sm text-gray-700">Type de voyage</label>
                        <select id="type_voyage" name="type_voyage" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Choisissez le type</option>
                            <option value="Détente/Plage">Détente/Plage</option>
                            <option value="Aventure/Montagne">Aventure/Montagne</option>
                            <option value="Culturel/Ville">Culturel/Ville</option>
                            <option value="Romantique">Romantique</option>
                            <option value="Familial">Familial</option>
                            <option value="Affaires">Affaires</option>
                        </select>
                    </div>

                    <!-- Budget -->
                    <div class="mb-4">
                        <label for="budget" class="block font-medium text-sm text-gray-700">Budget approximatif (€)</label>
                        <select id="budget" name="budget" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Sélectionnez votre budget</option>
                            <option value="500">Moins de 500€</option>
                            <option value="1000">500€ - 1000€</option>
                            <option value="2000">1000€ - 2000€</option>
                            <option value="3000">2000€ - 3000€</option>
                            <option value="5000">3000€ - 5000€</option>
                            <option value="5001">Plus de 5000€</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="/dashboard" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Réserver
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include '../layout.php';
?>