<x-app-layout>
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
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact') }}">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-6">
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <x-input-label for="message" :value="__('Message')" />
                        <textarea id="message" name="message" rows="6" class="block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" required>{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Envoyer') }}
                        </x-primary-button>
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
</x-app-layout>