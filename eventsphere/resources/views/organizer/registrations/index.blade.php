@extends('organizer.layout')

@section('content')
<div class="container">
    <h2>All Registrations</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Event</th>
                <th>Student</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $reg)
            <tr>
                <td>{{ $reg->event->title }}</td>
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
                    @if($reg->status != 'confirmed')
                        <a href="{{ route('organizer.registration.approve', $reg->id) }}" class="btn btn-sm btn-success">Approve</a>
                    @endif
                    @if($reg->status != 'rejected')
                        <a href="{{ route('organizer.registration.reject', $reg->id) }}" class="btn btn-sm btn-danger">Reject</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
