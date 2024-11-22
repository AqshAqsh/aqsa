@extends('layouts.admin-app')

@section('content')
    <h1>Notifications</h1>

    @if($notifications->isEmpty())
        <p>No new notifications.</p>
    @else
        <ul>
            @foreach($notifications as $notification)
                <li>
                    <strong>{{ $notification->data['message'] }}</strong>
                    <br>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                    <br>

                    <!-- Check if it's a new booking notification -->
                    @if(isset($notification->data['booking_id']))
                        <a href="{{ route('admin.bookings.list', $notification->data['booking_id']) }}">View Booking</a>
                    @else
                        <a href="{{ route('admin.feedback.list') }}">View Feedback</a>
                    @endif
                    <br>

                    <!-- Mark notification as read -->
                    <form method="POST" action="{{ route('admin.notifications.markAsRead', $notification->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Mark as Read</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
