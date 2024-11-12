<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Room;
use App\Models\Bed;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookRoom($roomId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to book a room.');
        }

        $userId = $user->user_id;
        if (!$userId) {
            dd("User  ID not set for the logged-in user.");
        }

        // Fetch the room along with its available beds
        $room = Room::with(['beds' => function ($query) {
            $query->where('status', 'available'); // Only fetch available beds
        }])->findOrFail($roomId);

        // Get available beds for the room
        $beds = $room->beds; // This will contain only available beds due to the eager loading

        return view('room.booking', compact('userId', 'room', 'beds'));
    }

    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to book a room.');
        }

        // Trim the bedno to avoid leading/trailing spaces
        $request->merge(['bedno' => trim($request->bedno)]);

        // Validate the booking request
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'bedno' => 'required|string|exists:beds,bed_no',
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
        Log::info($request->all());

        // Check if the selected bed is available
        $bed = Bed::where('bed_no', $request->bedno)->where('status', 'available')->first();

        if (!$bed) {
            return redirect()->back()->with('error', 'The selected bed is not available.')->withInput();
        }

        // Calculate total charge
        $roomCharge = $request->room_charge; // Ensure this is passed from the form
        $durationMonths = $request->duration_months;
        $totalCharge = $roomCharge * $durationMonths;
        Log::info('Total Charge: ' . $totalCharge);
        $userId = Auth::user()->user_id;

        // Create the booking request with status 'pending'
        Booking::create([
            'user_id' => $userId,
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

        // Update the bed status to booked
        $bed->update(['status' => 'booked']);

        return redirect()->route('room')->with('success', 'Booking request submitted successfully and is pending admin approval.');
    }

    private function calculateTotalCharge($roomId, $durationMonths): float
    {
        // Example logic to calculate total charge based on room ID and duration
        $room = Room::find($roomId);
        $chargePerMonth = $room ->charge_per_month; // Assuming there's a charge_per_month field in the Room model
        return $chargePerMonth * $durationMonths;
    }
}