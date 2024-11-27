<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomCategory;
use App\Models\Block; // Assuming there's a Block model for room data



class UserHomeController extends Controller
{
    public function index()
    {
        // Fetch categories, blocks, and facilities from the database
        $categories = RoomCategory::all();
        $rooms = Room::all(); // Assuming you have a Block model
        $facilities = Facility::all();

        // Pass data to the view
        return view('home', compact('categories', 'rooms', 'facilities'));
    }

    public function showWelcomePage()
    {
        $rooms = Room::take(3)->get();
        $facilities = Facility::all();
        return view('welcome', compact('rooms', 'facilities'));
    }

    public function showRoomsWithFilters(Request $request)
    {
        $facilities = Facility::all();

        $query = Room::with(['facilities', 'beds', 'block']); 

        if ($request->has('facilities') && !empty($request->facilities)) {
            $query->whereHas('facilities', function ($q) use ($request) {
                $q->whereIn('id', $request->facilities);
            });
        }

        // Fetch rooms that have available beds (where is_occupied = 0)
        $rooms = $query->whereHas('beds', function ($q) {
            $q->where('is_occupied', 0);
        })->paginate(10);

        return view('rooms', compact('rooms', 'facilities'));
    }
}
