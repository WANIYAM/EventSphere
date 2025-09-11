<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventSeating;
use Auth;

class OrganizerEventManagementController extends Controller
{
    // List all events for this organizer
    public function index()
    {
        $events = Event::withCount(['registrations as confirmed_count' => function ($q) {
            $q->where('status', 'confirmed');
        }])
        ->where('organizer_id', Auth::id())
        ->latest()
        ->get();
        return view('organizer.events.index', compact('events'));
    }

    // Show create form
    public function create()
    {
        return view('organizer.events.create');
    }

    // Store new event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'venue' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'max_participants' => 'required|integer|min:1',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'venue' => $request->venue,
            'date' => $request->date,
            'time' => $request->time,
            'organizer_id' => Auth::id(),
            'status' => 'pending',
            'max_participants' => $request->max_participants,
        ]);

        // Initialize seating
        EventSeating::create([
            'event_id' => $event->id,
            'venue' => $request->venue,
            'total_seats' => $request->max_participants,
            'seats_booked' => 0,
            'waitlist_enabled' => true,
        ]);

        return redirect()->route('organizer.events.index')->with('success', 'Event created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $event = Event::where('organizer_id', Auth::id())->findOrFail($id);
        return view('organizer.events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, $id)
    {
        $event = Event::where('organizer_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'venue' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'max_participants' => 'required|integer|min:1',
        ]);

        $event->update($request->only(['title','description','category','venue','date','time','max_participants']));
        $event->status = 'pending';
        $event->save();

        // Update seating if venue or max_participants changed
        $event->seating->update([
            'venue' => $request->venue,
            'total_seats' => $request->max_participants,
        ]);

        return redirect()->route('organizer.events.index')->with('success', 'Event updated successfully!');
    }

    // Delete event
    public function destroy($id)
    {
        $event = Event::where('organizer_id', Auth::id())->findOrFail($id);
        $event->delete(); // Seating will cascade
        return back()->with('success', 'Event deleted successfully!');
    }

    // Filter events by status
    public function status(Request $request)
    {
        $status = $request->get('status');

        $query = Event::withCount(['registrations as confirmed_count' => function ($q) {
            $q->where('status', 'confirmed');
        }])
        ->where('organizer_id', auth()->id());

        if ($status && in_array($status, ['pending','approved','rejected','canceled'])) {
            $query->where('status', $status);
        }

        $events = $query->orderBy('date')->get();

        return view('organizer.events.index', compact('events'));
    }

    // List participants for an event
    public function participants($eventId)
    {
        $event = Event::with('registrations.student')
            ->where('organizer_id', auth()->id())
            ->findOrFail($eventId);

        return view('organizer.events.participants', compact('event'));
    }

    // Show single event details (needed for resource controller completeness)
    public function show($id)
    {
        $event = Event::where('organizer_id', auth()->id())->findOrFail($id);
        return view('organizer.events.index', compact('event'));
    }
}
