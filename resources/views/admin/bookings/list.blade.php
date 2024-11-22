@extends('layouts.admin-app')
@section('title')
    Notice List
@endsection

@section('content')
<div class="container-fluid">
    <h2 class="text-center">Booking Requests</h2>
    <div class="h-line bg-dark"></div>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Room</th>
                <th>Room No</th>
                <th>Bed No</th>
                <th>Total Charge</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->fullname }}</td>
                <td>{{ $booking->room->category->name }}</td>
                <td>{{ $booking->room->room_no }}</td>
                <td>{{ $booking->bedno }}</td>
                <td>{{ $booking->total_charge }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>
                    @if ($booking->status == 'pending')
                        <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    @elseif ($booking->status == 'deleted by user')
                        <span class="text-muted">Deleted by User</span>
                    @else
                        <span>{{ ucfirst($booking->status) }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
