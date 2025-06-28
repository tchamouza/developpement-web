<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'pays',
        'description',
        'prix_base',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'prix_base' => 'decimal:2',
        ];
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'destination', 'nom');
    }
}