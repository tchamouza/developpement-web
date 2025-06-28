<x-app-layout>
    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/slider3.jpg') }}');">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-4 text-yellow-500">
                    Bienvenue sur airlineTRAVEL
                </h1>
                <p class="text-xl md:text-2xl mb-8">
                    Vous voulez voyager en toute sécurité et aisance ? Vous êtes à la bonne adresse.
                </p>
                <div class="space-x-4">
                    <a href="{{ route('services') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-black transition duration-300">
                        Découvrir
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-yellow-500 text-black px-8 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                            Mon espace
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-yellow-500 text-black px-8 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                            Se connecter
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations populaires -->
    @if($destinations->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Destinations Populaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($destinations as $destination)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    @if($destination->image)
                        <img src="{{ asset('images/' . $destination->image) }}" alt="{{ $destination->nom }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $destination->nom }}</h3>
                        <p class="text-gray-600 mb-4">{{ $destination->description }}</p>
                        @if($destination->prix_base)
                            <p class="text-lg font-bold text-yellow-600 mb-4">À partir de {{ number_format($destination->prix_base, 0, ',', ' ') }}€</p>
                        @endif
                        @auth
                            <a href="{{ route('reservations.create') }}" class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">
                                Réserver
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">
                                Se connecter pour réserver
                            </a>
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

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