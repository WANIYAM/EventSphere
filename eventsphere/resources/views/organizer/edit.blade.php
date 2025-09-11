@extends('organizer.layout')

@section('content')
<div class="container">
    <h2>Edit / Reschedule Event</h2>

    <form action="{{ url('/organizer/events/'.$event->id.'/update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category', $event->category) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" value="{{ old('date', $event->date) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Time</label>
            <input type="time" name="time" value="{{ old('time', $event->time) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Venue</label>
            <input type="text" name="venue" value="{{ old('venue', $event->venue) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Max Participants</label>
            <input type="number" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
        <a href="{{ url('/organizer/events') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
