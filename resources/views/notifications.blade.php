<!-- resources/views/notifications.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Notifications</h2>

    @if($notifications->isEmpty())
    <p>No notifications available.</p>
    @else
    <ul>
        @foreach ($notifications as $notification)
        <li>
            <p><strong>{{ $notification->data['message'] }}</strong></p>
            <p>Room ID: {{ $notification->data['room_id'] }}</p>
            <p>Status: {{ $notification->data['status'] }}</p>
            <a href="{{ url('user/booking/' . $notification->data['booking_id']) }}">View Booking</a>

            @if(!$notification->read_at)
            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">Mark as Read</button>
            </form>
            @endif
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection