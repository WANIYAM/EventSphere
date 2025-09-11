@extends('organizer.layout')

@section('content')
    <div class="container">
        <h2>My Events</h2>

        @if (session('success'))
            <div style="color:green">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div style="color:red">{{ session('error') }}</div>
        @endif

        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Time</th>
                <th>Venue</th>
                <th>Max Participants</th>
                <th>Status</th>
            </tr>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ ucfirst($event->status) }}</td>
                    <td>
                        <a href="{{ url('/organizer/events/' . $event->id . '/edit') }}">Edit/Reschedule</a> |
                        <form action="{{ url('/organizer/events/' . $event->id . '/cancel') }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button type="submit" style="color:red">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
