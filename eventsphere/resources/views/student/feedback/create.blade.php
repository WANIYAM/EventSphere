@extends('student.layout')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Feedback for: {{ $event->title }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('student.feedback.store', $event->id) }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Rating (1-5)</label>
                    <select name="rating" class="form-control" required>
                        <option value="">Select Rating</option>
                        @for($i=1; $i<=5; $i++)
                            <option value="{{ $i }}">{{ $i }} ★</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Comments</label>
                    <textarea name="comments" class="form-control" rows="4" placeholder="Write your feedback..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                <a href="{{ route('student.my-registrations') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
