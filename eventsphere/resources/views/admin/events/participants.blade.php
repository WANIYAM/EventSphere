@extends('admin.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h4>Participants for Event: {{ $event->title }}</h4>
    </div>
    <div class="card-body">
        @if($event->registrations->count() > 0)
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event->registrations as $reg)
                        <tr>
                            <td>{{ $reg->student->name ?? 'N/A' }}</td>
                            <td>{{ $reg->student->email ?? 'N/A' }}</td>
                            <td>
                                @if($reg->status === 'confirmed')
                                    <span class="badge bg-success">Confirmed</span>
                                @elseif($reg->status === 'waiting')
                                    <span class="badge bg-warning">Waitlist</span>
                                @elseif($reg->status === 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @elseif($reg->status === 'rejected')
                                    <span class="badge bg-dark">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $reg->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">No students registered for this event yet.</p>
        @endif
        <a href="#" class="btn btn-secondary mt-3">Back to Events</a>
    </div>
</div>
@endsection
