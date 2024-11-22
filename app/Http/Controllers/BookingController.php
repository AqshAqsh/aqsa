<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Bed;
use App\Models\User;
use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Notifications\NewBookingNotification;

class BookingController extends Controller
{
    // Show the booking form for a specific room number
    public function bookRoom($room_no)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to book a room.');
        }

        $userId = $user->user_id;
        if (!$userId) {
            dd("User ID not set for the logged-in user.");
        }

        // Fetch the room along with its available beds
        $room = Room::where('room_no', $room_no)
            ->with(['beds' => function ($query) {
                $query->where('status', 'available'); // Only fetch available beds
            }])->firstOrFail();

        $beds = $room->beds; // This will contain only available beds

        // Handle the case when no beds are available
        if ($beds->isEmpty()) {
            return redirect()->route('room')->with('error', 'No available beds in this room.');
        }

        return view('room.booking', compact('userId', 'room', 'beds'));
    }

    // Show the details of a specific booking
    public function show($id)
    {
        $user = Auth::user();

        // Find the booking by the booking ID and ensure it belongs to the logged-in user
        $booking = Booking::where('user_id', $user->user_id)->findOrFail($id);

        // Check if the booking is deleted or rejected
        if (strtolower(trim($booking->status)) === 'deleted' || strtolower(trim($booking->status)) === 'rejected') {

            // Check if the user has made any new booking requests (pending or approved)
            $newBooking = Booking::where('user_id', $user->user_id)
                ->whereIn('status', ['pending', 'approved'])
                ->where('id', '!=', $id) // Exclude the current deleted or rejected booking
                ->first();

            // If a new booking exists, display that instead of the deleted/rejected booking
            if ($newBooking) {
                return view('room.showbooking', ['booking' => $newBooking]);
            }

            // If no new booking exists, show the deleted or rejected booking
            return view('room.showbooking', compact('booking'));
        }

        // If the booking is not deleted or rejected, show the current booking details
        return view('room.showbooking', compact('booking'));
    }

    // Store a new booking request
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to book a room.');
        }

        // Validate the booking request
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'bedno' => ['required', 'string', function ($attribute, $value, $fail) {
                // Check if the bed is available
                $bed = Bed::where('bed_no', $value)->where('status', 'available')->first();
                if (!$bed) {
                    $fail('The selected bed is not available.');
                }
            }],
            'fullname' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'year_of_study' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'rollno' => 'required|string|max:50',
            'duration_months' => 'required|integer|min:1',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:15',
            'terms' => 'accepted',
        ]);

        // Check if the user has an existing booking with status 'approved' or 'pending'
        $userId = Auth::user()->user_id;
        $existingBooking = Booking::where('user_id', $userId)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        // Prevent a new booking if a previous one is approved or still pending
        if ($existingBooking) {
            return redirect()->route('room.booking', ['room_no' => $request->room_no])
                ->with('error', 'You cannot make a new booking request because you have an existing booking that is either approved or still pending.');
        }

        // Proceed with creating the booking
        $booking = $this->createBooking($request);

        // Notify the admin about the new booking
        $admin = Admin::first();
        if ($admin) {
            $admin->notify(new NewBookingNotification($booking));
        } else {
            Log::warning("No admin found to send booking notification.");
        }

        return redirect()->route('room')->with('success', 'Your booking request has been submitted successfully and is pending admin approval.');
    }

    // Helper method to create a new booking request
    private function createBooking(Request $request)
    {
        // Check if the selected bed is available before proceeding
        $bed = Bed::where('bed_no', $request->bedno)->where('status', 'available')->first();

        if (!$bed) {
            return redirect()->route('room.booking', ['room_no' => $request->room_id])
                ->with('error', 'The selected bed is not available.')
                ->withInput();
        }

        // Calculate total charge
        $room = Room::find($request->room_id);
        $roomCharge = $room ? $room->room_charge : 0;
        $durationMonths = $request->duration_months;
        $totalCharge = $roomCharge * $durationMonths;
        Log::info('Total Charge: ' . $totalCharge);

        // Create the booking request with status 'pending'
        $booking = Booking::create([
            'user_id' => Auth::user()->user_id,
            'room_id' => $request->room_id,
            'bedno' => $request->bedno,
            'total_charge' => $totalCharge,
            'fullname' => $request->fullname,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'year_of_study' => $request->year_of_study,
            'department' => $request->department,
            'rollno' => $request->rollno,
            'duration_months' => $request->duration_months,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'status' => 'pending', // Initial status is pending
            'booking_date' => now(),
        ]);

        // Mark the bed as booked (no longer available)
        $bed->status = 'booked';
        $bed->save();
        return $booking;
    }

    // Method to download a booking report as a PDF
    public function downloadReport($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('status', '!=', 'deleted by user') // Ensure deleted bookings are not accessible
            ->firstOrFail();

        // Prepare data for the PDF view
        $data = [
            'booking' => $booking,
            'user' => $booking->user,
            'room' => $booking->room,
        ];

        // Generate the PDF from a view
        $pdf = PDF::loadView('room.report', $data);

        // Return the generated PDF as a download
        return $pdf->download('booking_report_' . $booking->id . '.pdf');
    }

    // Delete or mark a booking as deleted by the user
    public function deleteBooking($id)
    {
        $user = Auth::user();
        $booking = Booking::findOrFail($id);

        // Ensure the booking belongs to the current user
        if ($booking->user_id !== $user->user_id) {
            return redirect()->route('room')->with('error', 'Unauthorized access.');
        }

        // Check the booking status. Only pending bookings can be deleted.
        if (strtolower(trim($booking->status)) !== 'pending') {
            return redirect()->route('room')->with('error', 'You can only delete a pending booking request.');
        }

        // Update booking status to 'deleted'
        $booking->status = 'deleted';
        $booking->save();

        // Optionally, update the bed status back to 'available'
        $bed = Bed::where('bed_no', $booking->bedno)->first();
        if ($bed) {
            $bed->status = 'available';
            $bed->save();
        }

        // Redirect with a success message
        return redirect()->route('room.showbooking')->with('success', 'Your booking request has been canceled. You can submit a new request.');
    }
}
