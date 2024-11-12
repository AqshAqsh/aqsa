@extends('layouts.admin-app')

@section('content')
<div class="container">
    <h2 class="text-center">Booking Requests</h2>
    <div class="h-line bg-dark"></div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Room</th>
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
                    <td>{{ $booking->bedno }}</td>
                    <td>{{ $booking->total_charge }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>
                        @if ($booking->status == 'pending')
                            <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <span class="badge badge-secondary">N/A</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection