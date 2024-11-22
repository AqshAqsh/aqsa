@extends('layouts.admin-app')
@section('content')
<div class="container">
    <h1>Feedbacks</h1>

    <!-- Flash message for success/failure -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Email</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedbacks as $feedback)
            <tr>
                <td>{{ $feedback->user_id }}</td>
                <td>{{ $feedback->email }}</td>
                <td>{{ $feedback->message }}</td>
                <td>{{ ucfirst($feedback->status) }}</td>
                <td>
                    <!-- Form for changing status -->
                    <form action="{{ route('admin.feedback.updateStatus', $feedback->id) }}" method="POST">
                        @csrf
                        <!-- Dropdown to select status -->
                        <div class="form-group">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="pending" {{ $feedback->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="reviewed" {{ $feedback->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                <option value="resolved" {{ $feedback->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection