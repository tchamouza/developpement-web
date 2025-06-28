<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination',
        'date_depart',
        'date_retour',
        'nombre_personnes',
        'type_voyage',
        'budget',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'date_depart' => 'date',
            'date_retour' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatutLabelAttribute()
    {
        return match($this->statut) {
            'en_attente' => 'En attente',
            'confirmee' => 'Confirmée',
            'annulee' => 'Annulée',
            default => $this->statut,
        };
    }

    public function getDurationAttribute()
    {
        return $this->date_depart->diffInDays($this->date_retour);
    }
}