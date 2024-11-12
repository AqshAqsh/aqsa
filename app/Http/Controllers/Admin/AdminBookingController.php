<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Events\BookingStatusUpdatedEvent;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Notifications\BookingStatusUpdated;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.bookings.list', compact('bookings'));
    }


    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'approved']);
        event(new BookingStatusUpdatedEvent($booking)); // Broadcast the event
        return redirect()->route('admin.bookings.list')->with('success', 'Booking approved successfully.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'rejected']);
        event(new BookingStatusUpdatedEvent($booking)); // Broadcast the event
        return redirect()->route('admin.bookings.list')->with('success', 'Booking rejected successfully.');
    }
    /* public function update(Request $request, $id)
    {
        // Validate the admin action
        $request->validate([
            'action' => 'required|in:accept,reject',
        ]);

        // Find the booking request
        $booking = Booking::findOrFail($id);

        // Update the booking status based on admin action
        if ($request->action === 'accept') {
            $booking->update(['status' => 'accepted']);
            // Optionally, you can mark the beds as booked here if needed
            // Bed::where('room_id', $booking->room_id)->update(['status' => 'booked']);
        } else {
            $booking->update(['status' => 'rejected']);
        }

        return redirect()->route('admin.bookings.list')->with('success', 'Booking request has been ' . $request->action . 'ed.');
    }*/
}
