<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Events\BookingStatusUpdatedEvent;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Bed;
use App\Models\Feedback;

use App\Notifications\BookingStatusUpdated;


class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->get();
        return view('admin.bookings.list', compact('bookings'));
    }
    public function showbedassign()
    {
        $beds = Bed::with('user')->get(); 

        return view('admin.bed.assigned', compact('beds'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = 'approved';
        $booking->save();

        // Get the user associated with the booking
        $user = $booking->user; 

        $bed = Bed::where('bed_no', $booking->bedno)
            ->where('room_id', $booking->room_id)
            ->first();

        if ($bed) {
            $bed->update([
                'is_occupied' => true,
                'status' => 'booked',
                'user_id' => $user->user_id  // Assign the bed to the user
            ]);
        }

        $user->notify(new BookingStatusUpdated($booking, 'approved'));

        return redirect()->route('admin.bookings.list')->with('success', 'Booking approved successfully');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        // Update the booking status to 'rejected'
        $booking->status = 'rejected';
        $booking->save();

        // Get the user associated with the booking
        $user = $booking->user;
        $bed = Bed::where('bed_no', $booking->bedno)
            ->where('room_id', $booking->room_id)
            ->first(); // Get the specific bed

        if ($bed) {
            // Mark the bed as occupied and assign the user to it
            $bed->update([
                'is_occupied' => false,
                'status' => 'available',
            ]);
        }

        // Send a rejection notification to the user
        $user->notify(new BookingStatusUpdated($booking, 'rejected'));

        // Redirect back with success message
        return redirect()->route('admin.bookings.list')->with('success', 'Booking rejected successfully');
    }
}
