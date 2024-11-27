@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center">Booking Details</h2>
    <div class="h-line bg-dark"></div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Personal Information</h4>
            <p><strong>Name:</strong> {{ $booking->user->name }}</p>
            <p><strong>Email:</strong> {{ $booking->user->email }}</p>
            <p><strong>Date of Birth:</strong> {{ $booking->date_of_birth }}</p>
            <p><strong>Gender:</strong> {{ $booking->gender }}</p>
            <p><strong>Year Of Study:</strong> {{ $booking->year_of_study }}</p>
            <p><strong>Department:</strong> {{ $booking->department }}</p>
            <p><strong>Roll No:</strong> {{ $booking->rollno }}</p>

            <h4 class="card-title">Room Information</h4>
            <p><strong>Room No:</strong> {{ $booking->room->room_no }}</p>
            <p><strong>Room Name:</strong> {{ $booking->room->category->name }}</p>
            <p><strong>Description:</strong> {{ $booking->room->description }}</p>
            <p><strong>Facilities:</strong>
                @foreach ($booking->room->facilities as $facility)
                {{ $facility->name }}@if (!$loop->last), @endif
                @endforeach
            </p>

            <h4 class="card-title">Booking Details</h4>
            <p><strong>Bed:</strong> {{ $booking->bedno }}</p>
            <p><strong>Duration:</strong> {{ $booking->duration_months }} months</p>
            <p><strong>Room Charges:</strong> Rs.{{ $booking->room->room_charge }} per month</p>
            <p><strong>Total Charges:</strong> Rs.{{ $booking->total_charge }}</p>

            <h4 class="card-title">Emergency Contact</h4>
            <p><strong>Name:</strong> {{ $booking->emergency_contact_name }}</p>
            <p><strong>Phone:</strong> {{ $booking->emergency_contact_phone }}</p>

            <h4 class="card-title">Status</h4>
            @if(strtolower(trim($booking->status)) === 'approved')
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-success">{{ $booking->status }}</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('room.report', $booking->id) }}" class="btn btn-success mt-3">Download Booking Report</a>
                </div>
            </div>
            @elseif(strtolower(trim($booking->status)) === 'rejected')
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-danger">{{ $booking->status }}</button>
                    <p class="mt-3">Your booking request has been rejected. You can submit a new booking request for another room.</p>
                    <!-- Redirect to the page where they can book a new room -->
                    <a href="{{ route('room') }}" class="btn btn-primary mt-3">Submit New Booking Request</a>
                </div>
            </div>
            @elseif(strtolower(trim($booking->status)) === 'pending')
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-warning">{{ $booking->status }}</button>
                    <!-- Add a cancel button to delete the booking request -->
                    <form action="{{ route('booking.delete', $booking->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel Booking Request</button>
                    </form>
                </div>
            </div>
            @elseif(strtolower(trim($booking->status)) === 'deleted')
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-dark">{{ $booking->status }}</button>
                    <p class="mt-3">Your booking request has been canceled. You can submit a new booking request.</p>
                    <a href="{{ route('room') }}" class="btn btn-primary mt-3">Submit New Booking Request</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection