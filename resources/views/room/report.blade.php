<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Report</title>
    <style>
        /* Add any styling you want for the report */
    </style>
</head>
<body>
    <h1>Booking Report</h1>

    <h2>Personal Information</h2>
    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
    <p><strong>Email:</strong> {{ $booking->user->email }}</p>
    <p><strong>Date of Birth:</strong> {{ $booking->date_of_birth }}</p>
    <p><strong>Gender:</strong> {{ $booking->gender }}</p>
    <p><strong>Year of Study:</strong> {{ $booking->year_of_study }}</p>
    <p><strong>Department:</strong> {{ $booking->department }}</p>
    <p><strong>Roll No:</strong> {{ $booking->rollno }}</p>

    <h2>Room Information</h2>
    <p><strong>Room No:</strong> {{ $booking->room->room_no }}</p>
    <p><strong>Room Name:</strong> {{ $booking->room->category->name }}</p>
    <p><strong>Description:</strong> {{ $booking->room->description }}</p>
    <p><strong>Facilities:</strong>
        @foreach ($booking->room->facilities as $facility)
            {{ $facility->name }}@if (!$loop->last), @endif
        @endforeach
    </p>

    <h2>Booking Details</h2>
    <p><strong>Bed:</strong> {{ $booking->bedno }}</p>
    <p><strong>Duration:</strong> {{ $booking->duration_months }} months</p>
    <p><strong>Room Charges:</strong> Rs.{{ $booking->room_charge }} per month</p>
    <p><strong>Total Charges:</strong> Rs.{{ $booking->total_charge }}</p>

    <h2>Emergency Contact</h2>
    <p><strong>Name:</strong> {{ $booking->emergency_contact_name }}</p>
    <p><strong>Phone:</strong> {{ $booking->emergency_contact_phone }}</p>

    <h2>Status</h2>
    <p><strong>Status:</strong> {{ $booking->status }}</p>
</body>
</html>
