@extends('admin.layout')

@section('content')
<div class="container">
    <h2>User Management</h2>

    <div class="mb-3 d-flex justify-content-between">
        <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name/email" class="form-control me-2">
            <select name="role" class="form-select me-2">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="organizer" {{ request('role')=='organizer' ? 'selected' : '' }}>Organizer</option>
                <option value="student" {{ request('role')=='student' ? 'selected' : '' }}>Student</option>
            </select>
            <button class="btn btn-primary">Filter</button>
        </form>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Add User</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</button>
                    </form>
                    <form action="{{ route('admin.users.resetPassword', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-warning">Reset Password</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
