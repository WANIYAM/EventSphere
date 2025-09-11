@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Pending Events</h2>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Time</th>
            <th>Venue</th>
            <th>Organizer</th>
            <th>Actions</th>
        </tr>
        @foreach($events as $event)
<tr>
    <td>{{ $event->title }}</td>
    <td>{{ ucfirst($event->status) }}</td>
    <td>
        <a href="{{ url('/admin/events/'.$event->id.'/edit') }}">Modify</a> |
        <form action="{{ url('/admin/events/'.$event->id.'/approve') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Approve</button>
        </form>
        <form action="{{ url('/admin/events/'.$event->id.'/reject') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="color:red">Reject</button>
        </form>
    </td>
</tr>
@endforeach

    </table>
</div>
@endsection
