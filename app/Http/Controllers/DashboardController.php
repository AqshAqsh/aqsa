<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;

class DashboardController extends Controller
{

    // Assuming Resident is your model for residents.

    public function dashboard()
    {
        // Retrieve total number of residents and rooms
        $totalResidents = User::count();
        $totalRooms = Room::count();
        $totalFeedbacks = Feedback::count();
        $totalBookings = Booking::count();


        // You can define your reference values to calculate percentages, e.g. total capacity
        $maxCapacity = 100; 
        $maxCapacityforbooking = 320; 

        // Calculate the percentages
        $residentPercentage = ($totalResidents / $maxCapacity) * 100;
        $roomPercentage = ($totalRooms / $maxCapacity) * 100;
        $feedbackPercentage = ($totalFeedbacks / $maxCapacity) * 100;
        $bookingPercentage = ($totalBookings / $maxCapacityforbooking) * 100;


        return view('admin.dashboard', compact('totalResidents', 'totalRooms', 'totalFeedbacks', 'feedbackPercentage',  'totalBookings', 'bookingPercentage', 'residentPercentage', 'roomPercentage'));
    }
}
