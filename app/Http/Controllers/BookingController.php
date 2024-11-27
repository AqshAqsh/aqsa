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

        $room = Room::where('room_no', $room_no)
            ->with(['beds' => function ($query) {
                $query->where('status', 'available'); // Only fetch available beds
            }])->firstOrFail();

        $beds = $room->beds; // This will contain only available beds

        if ($beds->isEmpty()) {
            return redirect()->route('room')->with('error', 'No available beds in this room.');
        }

        return view('room.booking', compact('userId', 'room', 'beds'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $booking = Booking::where('user_id', $user->user_id)->findOrFail($id);

        if (strtolower(trim($booking->status)) === 'deleted' || strtolower(trim($booking->status)) === 'rejected') {

            $newBooking = Booking::where('user_id', $user->user_id)
                ->whereIn('status', ['pending', 'approved'])
                ->where('id', '!=', $id)
                ->first();

            if ($newBooking) {
                return view('room.showbooking', ['booking' => $newBooking]);
            }

            return view('room.showbooking', compact('booking'));
        }

        return view('room.showbooking', compact('booking'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to book a room.');
        }

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'bedno' => ['required', 'string', function ($attribute, $value, $fail) {
                $bed = Bed::where('bed_no', $value)->where('status', 'available')->first();
                if (!$bed) {
                    $fail('The selected bed is not available.');
                }
            }],
            'fullname' => 'required|string|max:255|regex:/^[^\s]+(\s+[^\s]+)*$/',
            'date_of_birth' => 'required|date|before:-18 years',
            'gender' => 'required|string|max:10',
            'year_of_study' => 'required|string|regex:/^\d{4}-\d{4}$/',
            'department' => 'required|string|max:255',
            'rollno' => 'required|string|max:50',
            'duration_months' => 'required|integer|min:1',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|regex:/^[0-9]{11}$/|min:11|max:11',
            'terms' => 'accepted',
        ], [
            'date_of_birth.before' => 'You must be at least 18 years old.',
            'fullname.regex' => 'The fullname cannot have leading or trailing spaces.',
            'year_of_study.in' => 'Year of study must be between 2020 and 2024.',
        ]);
        $userId = Auth::user()->user_id;
        $existingBooking = Booking::where('user_id', $userId)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingBooking) {
            return redirect()->route('room.booking', ['room_no' => $request->room_no])
                ->with('error', 'You cannot make a new booking request because you have an existing booking that is either approved or still pending.');
        }

        $booking = $this->createBooking($request);
        $bed = Bed::where('bed_no', $booking->bedno)
            ->where('room_id', $booking->room_id)
            ->first();
        if ($bed) {
            $bed->update([
                $bed->status = 'booked',
            ]);
        }

        Log::info('Booking created. Attempting to notify admin. Booking ID: ' . $booking->id);


        $admin = Admin::first();
        if ($admin) {
            $admin->notify(new NewBookingNotification($booking));
        } else {
            Log::warning("No admin found to send booking notification.");
        }

        return redirect()->route('room')->with('success', 'Your booking request has been submitted successfully and is pending admin approval.');
    }

    private function createBooking(Request $request)
    {
        $bed = Bed::where('bed_no', $request->bedno)->where('status', 'available')->first();

        if (!$bed) {
            return redirect()->route('room.booking', ['room_no' => $request->room_id])
                ->with('error', 'The selected bed is not available.')
                ->withInput();
        }

        $room = Room::find($request->room_id);
        $roomCharge = $room ? $room->room_charge : 0;
        $durationMonths = $request->duration_months;
        $totalCharge = $roomCharge * $durationMonths;
        Log::info('Total Charge: ' . $totalCharge);

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
            'status' => 'pending',
            'booking_date' => now(),
        ]);

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
        return redirect()->route('room')->with('success', 'Your booking request has been canceled. You can submit a new request.');
    }
}
