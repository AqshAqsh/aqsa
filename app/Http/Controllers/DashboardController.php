<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;
use Spatie\Health\Facades\Health;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $admin = Auth::user();
        $totalResidents = User::count();
        $totalRooms = Room::count();
        $totalFeedbacks = Feedback::count();
        $totalBookings = Booking::where('status', 'approved')->count(); // Count approved bookings
        $facilitiesChart = new Chart;


        // Get approved bookings with user info
        $bookings = Booking::where('status', 'approved')
            ->with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($booking) use ($admin) {
                return [
                    'activity_type' => 'booking_approved',
                    'description' => "Booking #{$booking->id} approved by {$admin->name}",
                    'created_at' => $booking->created_at,
                    'user_name' => $booking->user->name,
                ];
            });

        // Get recent feedbacks
        $feedbacks = Feedback::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($feedback) {
                return [
                    'activity_type' => 'feedback_submitted',
                    'description' => "User \"{$feedback->user->name}\" submitted feedback",
                    'created_at' => $feedback->created_at,
                    'user_name' => $feedback->user->name,
                ];
            });

        // Merge bookings and feedbacks into a single collection
        $recentActivities = $bookings->merge($feedbacks)->sortByDesc('created_at');

        // Pagination logic for merged collection
        $perPage = 6; // Number of items per page
        $currentPage = request()->get('page', 1);
        $paginatedActivities = $recentActivities->forPage($currentPage, $perPage);

        $recentActivities = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedActivities,
            $recentActivities->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // Fetch top booked rooms
        $topBookedRooms = DB::table('rooms')
            ->select('rooms.*', DB::raw('(select count(*) from bookings where rooms.id = bookings.room_id) as bookings_count'))
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get();

        // Fetch facilities
        $facilities = DB::table('facilities')
            ->select('facilities.*', DB::raw('(select count(*) from rooms inner join facility_room on rooms.id = facility_room.room_id where facilities.id = facility_room.facility_id) as rooms_count'))
            ->havingRaw('rooms_count < 2')
            ->get();

        // Other capacity and percentages calculations
        $maxCapacity = 100;
        $maxCapacityforbooking = 320;

        $residentPercentage = ($totalResidents / $maxCapacity) * 100;
        $roomPercentage = ($totalRooms / $maxCapacity) * 100;
        $feedbackPercentage = ($totalFeedbacks / $maxCapacity) * 100;
        $bookingPercentage = ($totalBookings / $maxCapacityforbooking) * 100;

        $cpuUsage = $this->getCpuUsage(); // You need to define this method
        $memoryUsage = $this->getMemoryUsage();

        // Revenue calculations
        $totalRevenue = Booking::where('status', 'approved')->count();
        $monthlyRevenue = Booking::where('status', 'approved')
            ->whereMonth('created_at', now()->month)
            ->count();

        $labels = $topBookedRooms->pluck('room_no')->toArray();  // Get room numbers
        $values = $topBookedRooms->pluck('bookings_count')->toArray();

        $facilitiesChart->labels($labels)  // Room numbers as labels
            ->dataset('Top Booked Rooms', 'bar', $values)  // Number of bookings as values
            ->backgroundColor('#021a4d')
            ->color('#ffffff')
            ->options([
                'responsive' => true,
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                    ]
                ],
            ]);


        return view('admin.dashboard', compact(
            'totalResidents',
            'totalRooms',
            'cpuUsage',
            'memoryUsage',
            'totalFeedbacks',
            'feedbackPercentage',
            'recentActivities',
            'totalBookings',
            'bookingPercentage',
            'residentPercentage',
            'roomPercentage',
            'facilities',
            'topBookedRooms',
            'totalRevenue',
            'monthlyRevenue',
            'facilitiesChart',
        ));
    }
    public function getCpuUsage()
    {
        // For Windows, use the wmic command to get CPU load percentage
        $cpuUsage = shell_exec('wmic cpu get loadpercentage');  // For CPU load percentage in Windows
        return (int) trim($cpuUsage);  // Clean up the output and return the result
    }


    public function getMemoryUsage()
    {
        // Fetch memory usage information (this example works on Unix-like systems)
        $memoryUsage = shell_exec('free -m | grep Mem | awk \'{print $3}\'');  // In MB
        return (int)$memoryUsage;
    }
}
