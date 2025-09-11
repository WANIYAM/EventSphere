@extends('organizer.layout')

@section('content')
<div class="container">
    <h2>Edit Event</h2>

    <form action="{{ route('organizer.events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $event->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $event->category) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Venue</label>
            <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $event->date) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="time" class="form-control" value="{{ old('time', $event->time) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Max Participants</label>
            <input type="number" name="max_participants" class="form-control" value="{{ old('max_participants', $event->max_participants) }}" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection
