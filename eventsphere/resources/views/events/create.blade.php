@extends('organizer.layout')

@section('content')
<h1>{{ isset($event) ? 'Edit Event' : 'Create Event' }}</h1>

<form action="{{ isset($event) ? route('events.update', $event) : route('events.store') }}" method="POST">
    @csrf
    @if(isset($event))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ $event->title ?? old('title') }}" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required>{{ $event->description ?? old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category" class="form-control" value="{{ $event->category ?? old('category') }}" required>
    </div>

    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="date" class="form-control" value="{{ $event->date ?? old('date') }}" required>
    </div>

    <div class="mb-3">
        <label>Time</label>
        <input type="time" name="time" class="form-control" value="{{ $event->time ?? old('time') }}" required>
    </div>

    <div class="mb-3">
        <label>Venue</label>
        <input type="text" name="venue" class="form-control" value="{{ $event->venue ?? old('venue') }}" required>
    </div>

    <div class="mb-3">
        <label>Max Participants</label>
        <input type="number" name="max_participants" class="form-control" value="{{ $event->max_participants ?? old('max_participants') }}">
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($event) ? 'Update' : 'Create' }}</button>
</form>
@endsection
