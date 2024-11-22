<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;



class UserHomeController extends Controller
{
    public function index()
    {
        $rooms = Room::take(3)->get();
        $facilities = Facility::all();
        return view('home', compact('rooms', 'facilities'));
    }
    public function showWelcomePage()
    {
        $rooms = Room::take(3)->get();
        $facilities = Facility::all();
        return view('welcome', compact('rooms', 'facilities'));
    }

    public function showRoomsWithFilters(Request $request)
    {
        // Fetch all facilities
        $facilities = Facility::all();

        // Build the query to fetch rooms
        $query = Room::with(['facilities', 'beds', 'block']); // Use 'facilities' as the relation name

        // Filter rooms based on the selected facilities
        if ($request->has('facilities') && !empty($request->facilities)) {
            $query->whereHas('facilities', function ($q) use ($request) {
                $q->whereIn('id', $request->facilities);
            });
        }

        // Fetch rooms that have available beds (where is_occupied = 0)
        $rooms = $query->whereHas('beds', function ($q) {
            $q->where('is_occupied', 0);
        })->paginate(10);

        // Return the view with rooms and facilities
        return view('rooms', compact('rooms', 'facilities'));
    }
}
