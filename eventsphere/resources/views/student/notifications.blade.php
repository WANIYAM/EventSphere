@extends('student.layout')

@section('content')
<div class="container">
    <h3>My Notifications</h3>
    <ul class="list-group">
        @forelse($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $notification->data['title'] }}</strong><br>
                    {{ $notification->data['message'] }}
                    <small class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            </li>
        @empty
            <li class="list-group-item text-muted">No notifications yet</li>
        @endforelse
    </ul>
</div>
@endsection
