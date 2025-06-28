<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $reservations = $user->reservations()->latest()->get();
        
        $stats = [
            'total' => $reservations->count(),
            'confirmees' => $reservations->where('statut', 'confirmee')->count(),
            'en_attente' => $reservations->where('statut', 'en_attente')->count(),
            'annulees' => $reservations->where('statut', 'annulee')->count(),
        ];

        return view('dashboard', compact('reservations', 'stats'));
    }
}