<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenoms',
        'date_naissance',
        'email',
        'telephone',
        'photo_profil',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_naissance' => 'date',
        ];
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getFullNameAttribute()
    {
        return $this->prenoms . ' ' . $this->nom;
    }
}