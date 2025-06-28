<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'nom' => 'Paris',
                'pays' => 'France',
                'description' => 'La ville lumière avec ses monuments emblématiques',
                'prix_base' => 800.00,
                'image' => 'paris-france.jpeg',
            ],
            [
                'nom' => 'Tokyo',
                'pays' => 'Japon',
                'description' => 'Découvrez la culture japonaise et la modernité',
                'prix_base' => 1200.00,
                'image' => 'japon.jpg',
            ],
            [
                'nom' => 'Le Caire',
                'pays' => 'Égypte',
                'description' => 'Explorez les pyramides et l\'histoire antique',
                'prix_base' => 600.00,
                'image' => 'egypt.jpg',
            ],
            [
                'nom' => 'Rio de Janeiro',
                'pays' => 'Brésil',
                'description' => 'Plages paradisiaques et ambiance tropicale',
                'prix_base' => 900.00,
                'image' => 'bresil.jpg',
            ],
            [
                'nom' => 'Rome',
                'pays' => 'Italie',
                'description' => 'Art, histoire et gastronomie italienne',
                'prix_base' => 700.00,
                'image' => 'italie.jpg',
            ],
            [
                'nom' => 'Kingston',
                'pays' => 'Jamaïque',
                'description' => 'Détente et culture caribéenne',
                'prix_base' => 1000.00,
                'image' => 'jamaique.jpg',
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}