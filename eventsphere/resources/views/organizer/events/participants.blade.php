@extends('organizer.layout')

@section('content')
<div class="container">
    <h2>Participants for "{{ $event->title }}"</h2>
    <p>Seats: {{ $event->seating->seats_booked }} / {{ $event->seating->total_seats }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event->registrations as $reg)
            <tr>
                <td>{{ $reg->student->name }}</td>
                <td>{{ $reg->student->email }}</td>
                <td>
                    <span class="badge 
                        @if($reg->status=='confirmed') bg-success
                        @elseif($reg->status=='waiting') bg-warning
                        @elseif($reg->status=='rejected') bg-danger
                        @endif">
                        {{ ucfirst($reg->status) }}
                    </span>
                </td>
                <td>
                    @if($reg->status=='waiting' || $reg->status=='rejected')
                        <a href="{{ route('organizer.registration.approve', $reg->id) }}" class="btn btn-sm btn-success">Approve</a>
                    @endif
                    @if($reg->status=='confirmed' || $reg->status=='waiting')
                        <a href="{{ route('organizer.registration.reject', $reg->id) }}" class="btn btn-sm btn-danger">Reject</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
