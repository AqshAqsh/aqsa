@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 px-4">
            <div class="card mb-5 border-0 shadow">
                <div class="row g-0 p-1 align-items-center">
                    <h2><b>Your Notifications</b></h2>
                </div>
            </div>
        </div>
    </div>
    @if($notifications->isEmpty())
    <p>No notifications available.</p>
    @else
    <ul>
        @foreach ($notifications as $notification)
        <li>
            <p><strong>{{ $notification->data['message'] ?? 'Notification message not available' }}</strong></p>

            @if(isset($notification->data['feedback_id']))
            <p>Feedback: {{ $notification->data['feedback_message'] ?? 'No feedback message available' }}</p>
            <p>Status: {{ $notification->data['status'] ?? 'N/A' }}</p>
            <a class="btn btn-warning mb-2" href="{{ route('contact') }}">View Feedback</a>
            @endif

            @if(isset($notification->data['booking_id']))
            <p>Room Number: {{ $notification->data['room_no'] ?? 'N/A' }}</p>
            <p>Status: {{ $notification->data['status'] ?? 'N/A' }}</p>
            <a class="btn btn-warning mb-2" href="{{ url('user/booking/' . $notification->data['booking_id']) }}">View Booking</a>
            @endif

            @if(!$notification->read_at)
            <form action="{{ route('notification.read', $notification->id) }}" method="POST">
                @csrf
                <!-- Change <a> to <button> -->
                <button class="btn" style="background-color: #010142; color:bisque;" type="submit">Mark as Read</button>
            </form>
            @endif

            <br>
        </li>
        @endforeach
    </ul>
    @endif
</div>

@endsection