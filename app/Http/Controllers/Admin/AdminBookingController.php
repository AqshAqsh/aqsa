<?php

namespace App\Http\Controllers\Admin;

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

        $user = $booking->user; 

        $bed = Bed::where('bed_no', $booking->bedno)
            ->where('room_id', $booking->room_id)
            ->first();

        if ($bed) {
            $bed->update([
                'is_occupied' => true,
                'status' => 'booked',
                'user_id' => $user->user_id 
            ]);
        }

        $user->notify(new BookingStatusUpdated($booking, 'approved'));

        return redirect()->route('admin.bookings.list')->with('success', 'Booking approved successfully');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = 'rejected';
        $booking->save();

        $user = $booking->user;
        $bed = Bed::where('bed_no', $booking->bedno)
            ->where('room_id', $booking->room_id)
            ->first(); 

        if ($bed) {
            $bed->update([
                'is_occupied' => false,
                'status' => 'available',
            ]);
        }

        $user->notify(new BookingStatusUpdated($booking, 'rejected'));

        return redirect()->route('admin.bookings.list')->with('success', 'Booking rejected successfully');
    }
}
