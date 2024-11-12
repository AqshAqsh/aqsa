@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Booking Details</h2>
    <div class="h-line bg-dark"></div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Booking ID: {{ $booking->id }}</h5>
            <p><strong>Full Name:</strong> {{ $booking->fullname }}</p>
            <p><strong>Room:</strong> {{ $booking->room->category->name }}</p>
            <p><strong>Bed No:</strong> {{ $booking->bedno }}</p>
            <p><strong>Total Charge:</strong> {{ $booking->total_charge }}</p>
            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
            <p><strong>Created At:</strong> {{ $booking->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>Updated At:</strong> {{ $booking->updated_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    <h3 class="mt-4">Notifications</h3>
    @foreach (auth()->user()->notifications as $notification)
        @if ($notification->data['booking_id'] == $booking->id)
            <div class="notification">
                <p>Your booking status has been updated to: {{ ucfirst($notification->data['status']) }}</p>
                <form action="{{ route('notifications.read', $notification->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-link">Mark as Read</button>
                </form>
            </div>
        @endif
    @endforeach
</div>
@endsection