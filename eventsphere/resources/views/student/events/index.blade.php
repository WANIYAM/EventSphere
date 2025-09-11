@extends('student.layout')

@section('content')
<div class="container">
    <h3 class="mb-4">Available Events</h3>

    <!-- ==================== Filters ==================== -->
    <form method="GET" action="{{ route('student.events.index') }}" class="row mb-4 g-2">
        <div class="col-md-3">
            <input type="text" name="category" value="{{ request('category') }}" 
                   class="form-control" placeholder="Category">
        </div>
        <div class="col-md-3">
            <input type="date" name="from" value="{{ request('from') }}" 
                   class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" name="to" value="{{ request('to') }}" 
                   class="form-control">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <!-- ==================== Event Cards ==================== -->
    <div class="row">
        @forelse($events as $event)
            @php
                $registration = $registrations->firstWhere('event_id', $event->id);
            @endphp

            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p><strong>Date:</strong> {{ $event->date }} at {{ $event->time }}</p>
                        <p><strong>Venue:</strong> {{ $event->venue }}</p>
                        <p><strong>Category:</strong> {{ $event->category }}</p>
                        <p><strong>Seats:</strong> 
                           {{ $event->registrations()->where('status','confirmed')->count() }}
                           / {{ $event->max_participants }}
                        </p>

                        <!-- ==================== Buttons ==================== -->
                        @if($registration && $registration->status === 'confirmed')
                            <form method="POST" action="{{ route('student.events.cancel', $event->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Cancel Registration</button>
                            </form>
                        @elseif($registration && $registration->status === 'cancelled')
                            <form method="POST" action="{{ route('student.events.register', $event->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-warning">Re-Register</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('student.events.register', $event->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No events found matching your filters.</p>
        @endforelse
    </div>
</div>
@endsection
