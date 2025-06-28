<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Destination;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('reservations.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required|string|max:255',
            'date_depart' => 'required|date|after:today',
            'date_retour' => 'required|date|after:date_depart',
            'nombre_personnes' => 'required|string',
            'type_voyage' => 'required|string',
            'budget' => 'required|string',
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'destination' => $request->destination,
            'date_depart' => $request->date_depart,
            'date_retour' => $request->date_retour,
            'nombre_personnes' => $request->nombre_personnes,
            'type_voyage' => $request->type_voyage,
            'budget' => $request->budget,
        ]);

        return redirect()->route('dashboard')->with('success', 'Réservation créée avec succès !');
    }

    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        $destinations = Destination::all();
        return view('reservations.edit', compact('reservation', 'destinations'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        
        $request->validate([
            'destination' => 'required|string|max:255',
            'date_depart' => 'required|date|after:today',
            'date_retour' => 'required|date|after:date_depart',
            'nombre_personnes' => 'required|string',
            'type_voyage' => 'required|string',
            'budget' => 'required|string',
        ]);

        $reservation->update($request->only([
            'destination', 'date_depart', 'date_retour', 
            'nombre_personnes', 'type_voyage', 'budget'
        ]));

        return redirect()->route('dashboard')->with('success', 'Réservation mise à jour !');
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);
        $reservation->delete();
        return redirect()->route('dashboard')->with('success', 'Réservation supprimée !');
    }
}