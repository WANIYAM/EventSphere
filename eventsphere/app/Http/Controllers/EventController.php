<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'organizer') {
            $events = Event::where('organizer_id', $user->id)->get();
        } elseif ($user->role === 'admin') {
            $events = Event::all();
        } else {
            abort(403, 'Unauthorized');
        }

        return view('events.index', compact('events', 'user'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:50',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'date' => $request->date,
            'time' => $request->time,
            'venue' => $request->venue,
            'organizer_id' => auth()->id(),
            'status' => 'pending',
            'max_participants' => $request->max_participants,
        ]);

        return redirect()->route('events.index')->with('success', 'Event submitted for approval!');
    }

    public function edit(Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->organizer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->organizer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:50',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        $event->update(array_merge($request->all(), [
            'status' => $user->role === 'admin' ? $event->status : 'pending',
        ]));

        return redirect()->route('admin.pending')->with('success', 'Event updated successfully!');
    }

    public function cancel(Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->organizer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $event->update(['status' => 'rejected']);
        return redirect()->route('events.index')->with('success', 'Event canceled.');
    }

    public function approve(Event $event)
    {
        if (auth()->user()->role !== 'admin') abort(403, 'Unauthorized');
        $event->update(['status' => 'approved']);
        return redirect()->route('events.index')->with('success', 'Event approved.');
    }

    public function reject(Event $event)
    {
        if (auth()->user()->role !== 'admin') abort(403, 'Unauthorized');
        $event->update(['status' => 'rejected']);
        return redirect()->route('events.index')->with('success', 'Event rejected.');
    }
}
