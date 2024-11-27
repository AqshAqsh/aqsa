@extends('layouts.admin-app')
@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Feedbacks</h3>
            </span>
        </div>
    </div>

    <!-- Flash message for success/failure -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Feedbacks List</h4>
                    </p>
                    <table class="table table-hover">

                        <thead>
                            <tr>
                                <th>#</th>

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
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $feedback->user_id }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td  class="description-scroll">{{ $feedback->message }}</td>
                                <td>{{ ucfirst($feedback->status) }}</td>
                                <td>
                                    <!-- Form for changing status -->
                                    <form action="{{ route('admin.feedback.updateStatus', $feedback->id) }}" method="POST">
                                        @csrf
                                        <!-- Dropdown to select status -->  
                                        <div class="form-group">
                                            <select name="status" class="form-select" style="background-color: #010142; color:#ffff;" onchange="this.form.submit()">
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
            </div>
        </div>
    </div>
</div>
@endsection