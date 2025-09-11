@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h4>⭐ Event Ratings Summary</h4>
        </div>
        <div class="card-body">
            @if($eventRatings->count() > 0)
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Event</th>
                            <th>Average Rating</th>
                            <th>Total Feedbacks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventRatings as $summary)
                        <tr>
                            <td>{{ $summary->event->title ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ number_format($summary->avg_rating, 1) }} ★
                                </span>
                            </td>
                            <td>{{ $summary->total_feedbacks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No feedback has been submitted yet.</p>
            @endif
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h4>📋 Detailed Feedback</h4>
        </div>
        <div class="card-body">
            @if($feedbacks->count() > 0)
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Event</th>
                            <th>Student</th>
                            <th>Rating</th>
                            <th>Comments</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $fb)
                        <tr>
                            <td>{{ $fb->event->title ?? 'N/A' }}</td>
                            <td>{{ $fb->student->name ?? 'N/A' }}</td>
                            <td><span class="badge bg-info">{{ $fb->rating }} ★</span></td>
                            <td>{{ $fb->comments ?? '—' }}</td>
                            <td>{{ $fb->created_at->format('d M Y h:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $feedbacks->links() }}
                </div>
            @else
                <p class="text-muted">No feedback submitted yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
