<h2>Event Participants: {{ $event->title }}</h2>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Registered At</th>
    </tr>
    @foreach($event->registrations as $index => $registration)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $registration->user->name }}</td>
        <td>{{ $registration->user->email }}</td>
        <td>{{ $registration->created_at->format('d-m-Y') }}</td>
    </tr>
    @endforeach
</table>
