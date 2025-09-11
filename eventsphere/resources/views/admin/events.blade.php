@extends('admin.layout')

@section('content')
<h1>All Events (Admin)</h1>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Title</th>
            <th>Organizer</th>
            <th>Category</th>
            <th>Date</th>
            <th>Time</th>
            <th>Venue</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{ $event->title }}</td>
            <td>{{ $event->organizer->name }}</td>
            <td>{{ $event->category }}</td>
            <td>{{ $event->date }}</td>
            <td>{{ $event->time }}</td>
            <td>{{ $event->venue }}</td>
            <td>
                @if($event->status === 'pending')
                    <span class="badge bg-warning">Pending</span>
                @elseif($event->status === 'approved')
                    <span class="badge bg-success">Approved</span>
                @elseif($event->status === 'rejected')
                    <span class="badge bg-danger">Rejected</span>
                @elseif($event->status === 'canceled')
                    <span class="badge bg-secondary">Canceled</span>
                @endif
            </td>
            <td>
                @if($event->status === 'pending' || $event->status === 'rejected')
                    <form action="{{ route('events.approve', $event) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                    </form>

                    <form action="{{ route('events.reject', $event) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                    </form>
                @endif

                <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-info">Modify</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
