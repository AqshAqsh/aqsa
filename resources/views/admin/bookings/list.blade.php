@extends('layouts.admin-app')
@section('title')
Notice List
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Booking Requests</h3>
            </span>
        </div>
    </div>

    <br>

    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Booking  List</h4>
                    </p>
                    <table class="table table-hover">

                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <thead>
                            <tr>
                                <th>No. #</th>
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
                                <td>{{ $loop->iteration }}</td>
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
            </div>
        </div>
    </div>
</div>
@endsection