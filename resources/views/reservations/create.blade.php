<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('reservations.store') }}">
                        @csrf

                        <!-- Destination -->
                        <div class="mb-4">
                            <x-input-label for="destination" :value="__('Destination')" />
                            <select id="destination" name="destination" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Choisissez une destination</option>
                                <option value="France" {{ old('destination') == 'France' ? 'selected' : '' }}>France</option>
                                <option value="Japon" {{ old('destination') == 'Japon' ? 'selected' : '' }}>Japon</option>
                                <option value="Égypte" {{ old('destination') == 'Égypte' ? 'selected' : '' }}>Égypte</option>
                                <option value="Brésil" {{ old('destination') == 'Brésil' ? 'selected' : '' }}>Brésil</option>
                                <option value="Italie" {{ old('destination') == 'Italie' ? 'selected' : '' }}>Italie</option>
                                <option value="Jamaïque" {{ old('destination') == 'Jamaïque' ? 'selected' : '' }}>Jamaïque</option>
                                <option value="Grèce" {{ old('destination') == 'Grèce' ? 'selected' : '' }}>Grèce</option>
                                <option value="Maldives" {{ old('destination') == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                <option value="Thaïlande" {{ old('destination') == 'Thaïlande' ? 'selected' : '' }}>Thaïlande</option>
                                <option value="Autre" {{ old('destination') == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            <x-input-error :messages="$errors->get('destination')" class="mt-2" />
                        </div>

                        <!-- Date de départ -->
                        <div class="mb-4">
                            <x-input-label for="date_depart" :value="__('Date de départ')" />
                            <x-text-input id="date_depart" class="block mt-1 w-full" type="date" name="date_depart" :value="old('date_depart')" min="{{ date('Y-m-d') }}" required />
                            <x-input-error :messages="$errors->get('date_depart')" class="mt-2" />
                        </div>

                        <!-- Date de retour -->
                        <div class="mb-4">
                            <x-input-label for="date_retour" :value="__('Date de retour')" />
                            <x-text-input id="date_retour" class="block mt-1 w-full" type="date" name="date_retour" :value="old('date_retour')" min="{{ date('Y-m-d') }}" required />
                            <x-input-error :messages="$errors->get('date_retour')" class="mt-2" />
                        </div>

                        <!-- Nombre de personnes -->
                        <div class="mb-4">
                            <x-input-label for="nombre_personnes" :value="__('Nombre de personnes')" />
                            <select id="nombre_personnes" name="nombre_personnes" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Sélectionnez</option>
                                <option value="1" {{ old('nombre_personnes') == '1' ? 'selected' : '' }}>1 personne</option>
                                <option value="2" {{ old('nombre_personnes') == '2' ? 'selected' : '' }}>2 personnes</option>
                                <option value="3" {{ old('nombre_personnes') == '3' ? 'selected' : '' }}>3 personnes</option>
                                <option value="4" {{ old('nombre_personnes') == '4' ? 'selected' : '' }}>4 personnes</option>
                                <option value="5" {{ old('nombre_personnes') == '5' ? 'selected' : '' }}>5 personnes</option>
                                <option value="6+" {{ old('nombre_personnes') == '6+' ? 'selected' : '' }}>6 personnes ou plus</option>
                            </select>
                            <x-input-error :messages="$errors->get('nombre_personnes')" class="mt-2" />
                        </div>

                        <!-- Type de voyage -->
                        <div class="mb-4">
                            <x-input-label for="type_voyage" :value="__('Type de voyage')" />
                            <select id="type_voyage" name="type_voyage" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Choisissez le type</option>
                                <option value="Détente/Plage" {{ old('type_voyage') == 'Détente/Plage' ? 'selected' : '' }}>Détente/Plage</option>
                                <option value="Aventure/Montagne" {{ old('type_voyage') == 'Aventure/Montagne' ? 'selected' : '' }}>Aventure/Montagne</option>
                                <option value="Culturel/Ville" {{ old('type_voyage') == 'Culturel/Ville' ? 'selected' : '' }}>Culturel/Ville</option>
                                <option value="Romantique" {{ old('type_voyage') == 'Romantique' ? 'selected' : '' }}>Romantique</option>
                                <option value="Familial" {{ old('type_voyage') == 'Familial' ? 'selected' : '' }}>Familial</option>
                                <option value="Affaires" {{ old('type_voyage') == 'Affaires' ? 'selected' : '' }}>Affaires</option>
                            </select>
                            <x-input-error :messages="$errors->get('type_voyage')" class="mt-2" />
                        </div>

                        <!-- Budget -->
                        <div class="mb-4">
                            <x-input-label for="budget" :value="__('Budget approximatif (€)')" />
                            <select id="budget" name="budget" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Sélectionnez votre budget</option>
                                <option value="500" {{ old('budget') == '500' ? 'selected' : '' }}>Moins de 500€</option>
                                <option value="1000" {{ old('budget') == '1000' ? 'selected' : '' }}>500€ - 1000€</option>
                                <option value="2000" {{ old('budget') == '2000' ? 'selected' : '' }}>1000€ - 2000€</option>
                                <option value="3000" {{ old('budget') == '3000' ? 'selected' : '' }}>2000€ - 3000€</option>
                                <option value="5000" {{ old('budget') == '5000' ? 'selected' : '' }}>3000€ - 5000€</option>
                                <option value="5001" {{ old('budget') == '5001' ? 'selected' : '' }}>Plus de 5000€</option>
                            </select>
                            <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Annuler
                            </a>
                            <x-primary-button>
                                {{ __('Réserver') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validation des dates
        document.getElementById('date_depart').addEventListener('change', function() {
            const dateDepart = new Date(this.value);
            const dateRetour = document.getElementById('date_retour');
            
            // La date de retour doit être au moins le jour suivant
            const minRetour = new Date(dateDepart);
            minRetour.setDate(minRetour.getDate() + 1);
            
            dateRetour.min = minRetour.toISOString().split('T')[0];
            
            // Si la date de retour est antérieure, la réinitialiser
            if (dateRetour.value && new Date(dateRetour.value) <= dateDepart) {
                dateRetour.value = '';
            }
        });
    </script>
</x-app-layout>