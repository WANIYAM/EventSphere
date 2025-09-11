@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Manage Events</h2>

    <!-- ==================== Filters ==================== -->
    <form method="GET" action="{{ url('/admin/events') }}" class="row mb-4 g-2">
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">-- Select Status --</option>
                <option value="approved" {{ request('status')=='approved' ? 'selected' : '' }}>Approved</option>
                <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="rejected" {{ request('status')=='rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="canceled" {{ request('status')=='canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" name="category" value="{{ request('category') }}" 
                   class="form-control" placeholder="Category">
        </div>
        <div class="col-md-3">
            <input type="date" name="from" value="{{ request('from') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" name="to" value="{{ request('to') }}" class="form-control">
        </div>
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ url('/admin/events') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- ==================== Event Table ==================== -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Organizer</th>
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
                <td>{{ $event->organizer->name ?? 'Unknown' }}</td>
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
                    <a href="{{ url('/admin/events/'.$event->id.'/edit') }}" class="btn btn-sm btn-info">Modify</a>
                    <form action="{{ url('/admin/events/'.$event->id.'/approve') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                    </form>
                    <form action="{{ url('/admin/events/'.$event->id.'/reject') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                    </form>
                    <a href="{{ route('admin.events.participants', $event->id) }}" class="btn btn-sm btn-primary">Participants</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
