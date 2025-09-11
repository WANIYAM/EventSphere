@extends('organizer.layout')

@section('content')
<div class="container">
    <h2>Create New Event</h2>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif

    <form action="{{ url('/organizer/events') }}" method="POST">
        @csrf
        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title')<div style="color:red">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Description</label>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description')<div style="color:red">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category') }}">
            @error('category')<div style="color:red">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Date</label>
            <input type="date" name="date" value="{{ old('date') }}">
            @error('date')<div style="color:red">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Time</label>
            <input type="time" name="time" value="{{ old('time') }}">
            @error('time')<div style="color:red">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Venue</label>
            <input type="text" name="venue" value="{{ old('venue') }}">
            @error('venue')<div style="color:red">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Max Participants</label>
            <input type="number" name="max_participants" value="{{ old('max_participants') }}">
            @error('max_participants')<div style="color:red">{{ $message }}</div>@enderror
        </div>

        <button type="submit">Submit Event</button>
    </form>
</div>
@endsection
