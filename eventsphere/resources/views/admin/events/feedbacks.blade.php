@extends('admin.layout')

@section('content')
<div class="container">
    <h3>Feedbacks for {{ $event->title }}</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Rating</th>
                <th>Feedback</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event->feedbacks as $fb)
            <tr>
                <td>{{ $fb->student->name }}</td>
                <td>{{ $fb->rating ? $fb->rating.' ⭐' : 'N/A' }}</td>
                <td>{{ $fb->feedback }}</td>
                <td>{{ $fb->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
