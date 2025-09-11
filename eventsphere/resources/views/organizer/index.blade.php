@extends('organizer.layout')

@section('content')
<div class="container">
    <h2>My Events</h2>

    <a href="{{ url('/organizer/events/create') }}" class="btn btn-primary mb-3">+ Create New Event</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date & Time</th>
                <th>Venue</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->date }} {{ $event->time }}</td>
                <td>{{ $event->venue }}</td>
                <td>
                    <span class="badge 
                        @if($event->status == 'approved') bg-success
                        @elseif($event->status == 'rejected') bg-danger
                        @elseif($event->status == 'canceled') bg-secondary
                        @else bg-warning
                        @endif">
                        {{ ucfirst($event->status) }}
                    </span>
                </td>
                <td>
                    @if($event->status != 'canceled')
                        <a href="{{ url('/organizer/events/'.$event->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ url('/organizer/events/'.$event->id.'/cancel') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this event?')">Cancel</button>
                        </form>
                    @else
                        <em>Canceled</em>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
