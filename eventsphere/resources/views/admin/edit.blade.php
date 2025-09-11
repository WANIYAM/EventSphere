@extends('admin.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Event - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4e73df;
            --secondary: #6c757d;
            --success: #1cc88a;
            --light-bg: #f8f9fc;
            --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        body {
            background-color: var(--light-bg);
            color: #5a5c69;
        }
        
        .admin-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        
        .admin-card {
            background: #fff;
            border-radius: 0.35rem;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .admin-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .admin-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #4e73df;
            margin: 0;
        }
        
        .admin-icon {
            background: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #4e73df;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 0.35rem;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn {
            border-radius: 0.35rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-success {
            background: var(--success);
            border-color: var(--success);
        }
        
        .btn-secondary {
            background: var(--secondary);
            border-color: var(--secondary);
        }
        
        .btn-success:hover {
            background: #17a673;
            border-color: #17a673;
            transform: translateY(-2px);
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            border-color: #5a6268;
            transform: translateY(-2px);
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e3e6f0;
        }
        
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                text-align: center;
            }
            
            .admin-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-card">
            <div class="admin-header">
                <div class="admin-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h1 class="admin-title">Modify Event (Admin)</h1>
            </div>

            <form action="{{ url('/admin/events/'.$event->id.'/update') }}" method="POST">
                @csrf

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $event->title) }}" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" value="{{ old('category', $event->category) }}" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" value="{{ old('date', $event->date) }}" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Time</label>
                        <input type="time" name="time" value="{{ old('time', $event->time) }}" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Venue</label>
                        <input type="text" name="venue" value="{{ old('venue', $event->venue) }}" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Max Participants</label>
                        <input type="number" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}" class="form-control">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ $event->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $event->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $event->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="canceled" {{ $event->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>

                <div class="action-buttons">
                    <a href="{{ url('/admin/events') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Submit Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection