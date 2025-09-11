@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select" required>
                <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="organizer" {{ $user->role=='organizer' ? 'selected' : '' }}>Organizer</option>
                <option value="student" {{ $user->role=='student' ? 'selected' : '' }}>Student</option>
            </select>
        </div>
        <button class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
