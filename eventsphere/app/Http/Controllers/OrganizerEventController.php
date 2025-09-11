<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class OrganizerEventController extends Controller
{
    // List all my events with confirmed counts
    public function myEvents()
    {
        $events = Event::withCount(['registrations as confirmed_count' => function ($q) {
            $q->where('status', 'confirmed');
        }])
        ->where('organizer_id', Auth::id())
        ->orderBy('date', 'asc')
        ->get();

        return view('organizer.events.my-events', compact('events'));
    }

    // Filter events by status
    public function status($status)
    {
        if(!in_array($status, ['pending','approved','rejected','canceled'])) {
            abort(404); // prevent invalid status
        }

        $events = Event::withCount(['registrations as confirmed_count' => function ($q) {
            $q->where('status', 'confirmed');
        }])
        ->where('organizer_id', Auth::id())
        ->where('status', $status)
        ->orderBy('date', 'asc')
        ->get();

        return view('organizer.events.my-events', compact('events', 'status'));
    }

    // Show participants of a specific event
    public function participants($eventId)
    {
        $event = Event::with(['registrations.student', 'seating'])
            ->where('organizer_id', Auth::id())
            ->findOrFail($eventId);

        return view('organizer.events.participants', compact('event'));
    }

    // Approve a registration
    public function approveRegistration($id)
    {
        $registration = Registration::with('event.seating')->findOrFail($id);

        if($registration->status != 'confirmed') {
            $registration->status = 'confirmed';
            $registration->save();

            if($registration->event->seating) {
                $registration->event->seating->increment('seats_booked');
            }
        }

        return back()->with('success', 'Registration approved!');
    }

    // Reject a registration
    public function rejectRegistration($id)
    {
        $registration = Registration::with('event.seating')->findOrFail($id);

        if($registration->status == 'confirmed' && $registration->event->seating) {
            $registration->event->seating->decrement('seats_booked');
        }

        $registration->status = 'rejected';
        $registration->save();

        return back()->with('success', 'Registration rejected!');
    }
    // / Show all events
    public function index()
    {
        $events = Event::where('organizer_id', auth()->id())->get();
        return view('organizer.events.index', compact('events'));
    }

    // Pending events
    public function pending()
    {
        $events = Event::where('organizer_id', auth()->id())
                        ->where('status', 'pending')
                        ->get();
        return view('organizer.events.index', compact('events'));
    }

    // Approved events
    public function approved()
    {
        $events = Event::where('organizer_id', auth()->id())
                        ->where('status', 'approved')
                        ->get();
        return view('organizer.events.index', compact('events'));
    }

    // Rejected events
    public function rejected()
    {
        $events = Event::where('organizer_id', auth()->id())
                        ->where('status', 'rejected')
                        ->get();
        return view('organizer.events.index', compact('events'));
    }

    // Canceled events
    public function canceled()
    {
        $events = Event::where('organizer_id', auth()->id())
                        ->where('status', 'canceled')
                        ->get();
        return view('organizer.events.index', compact('events'));
    }

    // Show form to create new event
    public function create()
    {
        return view('organizer.events.create');
    }

    // Store new event
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string',
            'max_participants' => 'required|integer|min:1',
        ]);

        $data['organizer_id'] = auth()->id();
        $data['status'] = 'pending';

        Event::create($data);

        return redirect()->route('organizer.events.index')
                         ->with('success', 'Event created successfully.');
    }

    // Edit event
    public function edit($id)
    {
        $event = Event::where('organizer_id', auth()->id())->findOrFail($id);
        return view('organizer.events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, $id)
    {
        $event = Event::where('organizer_id', auth()->id())->findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string',
            'max_participants' => 'required|integer|min:1',
        ]);

        $event->update($data);

        return redirect()->route('organizer.events.index')
                         ->with('success', 'Event updated successfully.');
    }
    // List all registrations for organizer's events
public function allRegistrations()
{
    $registrations = Registration::with(['student', 'event'])
        ->whereHas('event', function($q) {
            $q->where('organizer_id', Auth::id());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('organizer.registrations.index', compact('registrations'));
}

}
