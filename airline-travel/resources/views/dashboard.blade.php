<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Section de bienvenue -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-8 rounded-lg mb-8">
                <h1 class="text-3xl font-bold mb-2">Bienvenue, {{ auth()->user()->full_name }} !</h1>
                <p class="text-lg">Gérez vos voyages et découvrez de nouvelles destinations</p>
            </div>

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['total'] }}</div>
                    <div class="text-gray-600">Réservations totales</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['confirmees'] }}</div>
                    <div class="text-gray-600">Voyages confirmés</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold text-yellow-600">{{ $stats['en_attente'] }}</div>
                    <div class="text-gray-600">En attente</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold text-red-600">{{ $stats['annulees'] }}</div>
                    <div class="text-gray-600">Annulées</div>
                </div>
            </div>

            <!-- Réservations -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold">Mes Réservations</h3>
                        <a href="{{ route('reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Nouvelle Réservation
                        </a>
                    </div>

                    @if($reservations->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Aucune réservation trouvée.</p>
                            <a href="{{ route('reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Faire ma première réservation
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($reservations as $reservation)
                                <div class="border rounded-lg p-4 hover:shadow-md transition duration-300">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="text-xl font-semibold">{{ $reservation->destination }}</h4>
                                        <span class="px-3 py-1 rounded-full text-sm font-medium
                                            @if($reservation->statut === 'confirmee') bg-green-100 text-green-800
                                            @elseif($reservation->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $reservation->statut_label }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <strong>Dates:</strong><br>
                                            Du {{ $reservation->date_depart->format('d/m/Y') }}
                                            au {{ $reservation->date_retour->format('d/m/Y') }}
                                            <br><small class="text-gray-500">({{ $reservation->duration }} jours)</small>
                                        </div>
                                        <div>
                                            <strong>Personnes:</strong> {{ $reservation->nombre_personnes }}<br>
                                            <strong>Type:</strong> {{ $reservation->type_voyage }}
                                        </div>
                                        <div>
                                            <strong>Budget:</strong> {{ $reservation->budget }}€<br>
                                            <strong>Réservé le:</strong> {{ $reservation->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    @if($reservation->statut === 'en_attente')
                                        <div class="mt-4 space-x-2">
                                            <a href="{{ route('reservations.edit', $reservation) }}" class="text-blue-600 hover:text-blue-800">Modifier</a>
                                            <form method="POST" action="{{ route('reservations.destroy', $reservation) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>