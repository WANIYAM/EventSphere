<?php
namespace App\Http\Controllers;

use App\Models\Event;

class PublicEventController extends Controller
{
    public function index()
    {
        $events = Event::where('status','approved')
            ->orderBy('date', 'asc')
            ->get();

        return view('events.index', compact('events'));
    }
}

