@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upcoming Events</h2>

    @if($events->isEmpty())
        <p>No upcoming events.</p>
    @else
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Time</th>
                <th>Venue</th>
                <th>Max Participants</th>
            </tr>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->category }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->time }}</td>
                <td>{{ $event->venue }}</td>
                <td>{{ $event->max_participants ?? '-' }}</td>
            </tr>
            @endforeach
        </table>
    @endif
</div>
@endsection
