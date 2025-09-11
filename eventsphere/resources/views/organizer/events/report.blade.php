@extends('organizer.layout')

@section('content')
<div class="container">
    <h2>Events Report</h2>

    <!-- Filter Form -->
    <div class="mb-3">
        <form method="GET" action="{{ route('organizer.events.report') }}" class="d-flex gap-2">
            <select name="status" class="form-select w-auto">
                <option value="">All Status</option>
                <option value="pending" @if (request('status') == 'pending') selected @endif>Pending</option>
                <option value="approved" @if (request('status') == 'approved') selected @endif>Approved</option>
                <option value="rejected" @if (request('status') == 'rejected') selected @endif>Rejected</option>
                <option value="canceled" @if (request('status') == 'canceled') selected @endif>Canceled</option>
            </select>
            <button type="submit" class="btn btn-secondary">Filter</button>
        </form>
    </div>

    <!-- Create New Event -->
    <div class="mb-3">
        <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">Create New Event</a>
    </div>

    <!-- Events Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date & Time</th>
                <th>Venue</th>
                <th>Confirmed / Max</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->date }} {{ $event->time }}</td>
                    <td>{{ $event->venue }}</td>
                    <td>{{ $event->confirmed_count ?? 0 }} / {{ $event->max_participants }}</td>
                    <td>
                        <span class="badge 
                            @if ($event->status == 'approved') bg-success
                            @elseif($event->status == 'rejected') bg-danger
                            @elseif($event->status == 'canceled') bg-secondary
                            @else bg-warning @endif">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('organizer.events.edit', $event->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <a href="{{ route('organizer.events.participants', $event->id) }}" class="btn btn-sm btn-primary">Participants</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No events found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
