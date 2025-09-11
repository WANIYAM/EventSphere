@extends('organizer.layout')

@section('content')
<h3>{{ $event->title }} - Participants</h3>
<p>Confirmed Slots: {{ $event->registrations->where('status','confirmed')->count() }} / {{ $event->max_participants }}</p>

@if($event->registrations->count() > 0)
<table class="table table-bordered mt-3">
    <thead class="table-light">
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
            <td>{{ $reg->student->name ?? 'N/A' }}</td>
            <td>{{ $reg->student->email ?? 'N/A' }}</td>
            <td>{{ ucfirst($reg->status) }}</td>
            <td>
                @if($reg->status == 'pending')
                    <form method="POST" action="{{ route('organizer.registrations.approve', $reg->id) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-success">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('organizer.registrations.reject', $reg->id) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger">Reject</button>
                    </form>
                @elseif($reg->status == 'confirmed')
                    <span class="badge bg-success">Confirmed</span>
                @elseif($reg->status == 'rejected')
                    <span class="badge bg-danger">Rejected</span>
                @elseif($reg->status == 'cancelled')
                    <span class="badge bg-warning">Cancelled</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="text-muted">No participants registered yet.</p>
@endif
@endsection
