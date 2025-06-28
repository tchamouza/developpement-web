<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = Destination::take(6)->get();
        return view('home', compact('destinations'));
    }

    public function services()
    {
        $destinations = Destination::all();
        return view('services', compact('destinations'));
    }

    public function about()
    {
        return view('about');
    }
}