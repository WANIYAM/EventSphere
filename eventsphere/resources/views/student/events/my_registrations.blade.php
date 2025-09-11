@extends('student.layout')

@section('content')

    {{-- =================== My Registrations =================== --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4>📝 My Registrations</h4>
        </div>
        <div class="card-body">
            @if (isset($registrations) && $registrations->count() > 0)
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $reg)
                            <tr>
                                <td>{{ $reg->event->title ?? 'N/A' }}</td>
                                <td>{{ $reg->event->date ?? 'N/A' }}</td>
                                <td>{{ $reg->event->venue ?? 'N/A' }}</td>
                                <td>
                                    @if ($reg->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($reg->status == 'waiting')
                                        <span class="badge bg-warning">Waitlist</span>
                                    @elseif($reg->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($reg->status == 'confirmed')
                                        <form method="POST" action="{{ route('student.events.cancel', $reg->event_id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                        </form>
                                    @elseif($reg->status == 'cancelled')
                                        <form method="POST"
                                            action="{{ url('/student/events/' . $reg->event_id . '/register') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">Re-Register</button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                <td>
                                    {{-- Feedback button (if not yet given) --}}
                                    @if ($reg->event && \Carbon\Carbon::parse($reg->event->date)->isPast())
                                        @if (!$reg->event->feedback()->where('student_id', auth()->id())->exists())
                                            <a href="{{ route('student.feedback.create', $reg->event_id) }}"
                                                class="btn btn-sm btn-primary">Give Feedback</a>
                                        @else
                                            <span class="badge bg-success">Feedback Given</span>
                                        @endif

                                        {{-- View Peer Reviews --}}
                                        <a href="{{ route('student.feedback.peer', $reg->event_id) }}"
                                            class="btn btn-sm btn-info mt-1">
                                            View Peer Reviews
                                        </a>
                                    @endif
                                </td>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">You have not registered for any events yet.</p>
            @endif
        </div>
    </div>
@endsection
