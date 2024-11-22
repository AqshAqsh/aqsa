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
        $bookings = Booking::all();
        return view('admin.bookings.list', compact('bookings'));
    }
    public function updateFeedbackStatus(Request $request, $feedbackId)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
        ]);

        // Find the feedback by ID
        $feedback = Feedback::findOrFail($feedbackId);

        // Update the status
        $feedback->status = $request->input('status');
        $feedback->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Feedback status updated successfully!');
    }
    public function showbedassign()
    {
        // Fetch all beds, you can filter or paginate if needed
        $beds = Bed::with('user')->get(); // Eager load the user relationship

        return view('admin.bed.assigned', compact('beds'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        // Update the booking status to 'approved'
        $booking->status = 'approved';
        $booking->save();

        // Get the user associated with the booking
        $user = $booking->user; // Assuming the booking has a user relationship

        // Check if the booking has a valid bed assignment (adjust based on your logic)
        $bed = Bed::where('bed_no', $booking->bedno)
            ->where('room_id', $booking->room_id)
            ->first(); // Get the specific bed

        if ($bed) {
            // Mark the bed as occupied and assign the user to it
            $bed->update([
                'is_occupied' => true,
                'status' => 'booked',
                'user_id' => $user->user_id  // Assign the bed to the user
            ]);
        }

        // Send a notification to the user
        $user->notify(new BookingStatusUpdated($booking, 'approved'));

        // Redirect back with success message
        return redirect()->route('admin.bookings.list')->with('success', 'Booking approved successfully');
    }

    // Reject a booking
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
