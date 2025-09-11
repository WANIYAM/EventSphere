@extends('admin.layout')

@section('content')
<div class="card-header">
    <h5>Dashboard Overview</h5>
</div>

<div class="card-block">
    {{-- Top Stats --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Events</h6>
                    <h2 class="text-right">
                        <i class="ti-calendar f-left"></i>
                        <span>{{ $totalEvents ?? 0 }}</span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Users</h6>
                    <h2 class="text-right">
                        <i class="ti-user f-left"></i>
                        <span>{{ $totalUsers ?? 0 }}</span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Pending Events</h6>
                    <h2 class="text-right">
                        <i class="ti-timer f-left"></i>
                        <span>{{ $pendingEvents ?? 0 }}</span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Tickets Sold</h6>
                    <h2 class="text-right">
                        <i class="ti-ticket f-left"></i>
                        <span>{{ $ticketsSold ?? 0 }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Events --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5>Recent Events</h5>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Organizer</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($recentEvents ?? [] as $event)
        <tr>
            <td>{{ $event->title }}</td>
            <td>{{ $event->organizer->name ?? 'N/A' }}</td>
<td>{{ optional($event->created_at)->format('M d, Y') ?? 'N/A' }}</td>
            <td>
                <span class="badge 
                    @if($event->status == 'approved') badge-success 
                    @elseif($event->status == 'pending') badge-warning
                    @elseif($event->status == 'rejected') badge-danger
                    @else badge-secondary
                    @endif">
                    {{ ucfirst($event->status) }}
                </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">No recent events</td>
        </tr>
    @endforelse
</tbody>


                </table>
            </div>
        </div>
    </div>

    {{-- Event Status Progress --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5>Event Status Overview</h5>
        </div>
        <div class="card-block">
            <div class="stat-row">
                <div class="stat-label">Approved</div>
                <div class="stat-value">{{ $approved }}</div>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: {{ ($approved / $total) * 100 }}%"></div>
                </div>
            </div>
            <div class="stat-row">
                <div class="stat-label">Rejected</div>
                <div class="stat-value">{{ $rejected }}</div>
                <div class="progress">
                    <div class="progress-bar bg-danger" style="width: {{ ($rejected / $total) * 100 }}%"></div>
                </div>
            </div>
            <div class="stat-row">
                <div class="stat-label">Canceled</div>
                <div class="stat-value">{{ $canceled }}</div>
                <div class="progress">
                    <div class="progress-bar bg-secondary" style="width: {{ ($canceled / $total) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
