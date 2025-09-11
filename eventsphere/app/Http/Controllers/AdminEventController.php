<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    // ==================== List All Events ====================
    public function index(Request $request)
    {
        $query = Event::with('organizer');

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $events = $query->orderBy('date', 'asc')->get();

        return view('admin.events.index', compact('events'));
    }

    // ==================== Edit & Update Event ====================
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:pending,approved,rejected,canceled',
        ]);

        $event->update($request->all());

        // Optionally mark approved_by/approved_at if status is approved
        if ($request->status === 'approved') {
            $event->approved_by = auth()->id();
            $event->approved_at = now();
            $event->save();
        }

        return redirect()->back()->with('success', 'Event updated successfully.');
    }

    // ==================== Approve / Reject Event ====================
    public function approve($id)
    {
        $event = Event::findOrFail($id);
        $event->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Event approved.');
    }

    public function reject($id)
    {
        $event = Event::findOrFail($id);
        $event->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Event rejected.');
    }

    // ==================== View Participants ====================
    public function participants($id)
    {
        $event = Event::with('registrations.student')->findOrFail($id);
        return view('admin.events.participants', compact('event'));
    }

    // ==================== View Feedbacks ====================
    public function feedbacks($eventId)
    {
        $event = Event::with('feedbacks.student')->findOrFail($eventId);
        return view('admin.events.feedbacks', compact('event'));
    }

    // ==================== Quick Filters ====================
    public function pending()   { return $this->filterByStatus('pending'); }
    public function approved()  { return $this->filterByStatus('approved'); }
    public function rejected()  { return $this->filterByStatus('rejected'); }
    public function canceled()  { return $this->filterByStatus('canceled'); }

    private function filterByStatus($status)
    {
        $events = Event::where('status', $status)->with('organizer')->orderBy('date', 'asc')->get();
        return view('admin.events.index', compact('events'));
    }
}
