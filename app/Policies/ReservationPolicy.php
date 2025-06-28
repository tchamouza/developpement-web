<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;

class ReservationPolicy
{
    public function view(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id;
    }

    public function update(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id && $reservation->statut === 'en_attente';
    }

    public function delete(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id && $reservation->statut === 'en_attente';
    }
}