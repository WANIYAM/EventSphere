@extends('student.layout')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Peer Reviews for: {{ $event->title }}</h4>
        </div>
        <div class="card-body">
            @if($feedbacks->count() > 0)
                <ul class="list-group">
                    @foreach($feedbacks as $fb)
                        <li class="list-group-item">
                            <strong>{{ $fb->student->name ?? 'Anonymous' }}</strong>
                            <span class="badge bg-info ms-2">{{ $fb->rating }} ★</span>
                            <p class="mb-0">{{ $fb->comments ?? '—' }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No peer reviews available yet.</p>
            @endif
            <a href="{{ route('student.my-registrations') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>
</div>
@endsection
