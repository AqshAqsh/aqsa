<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomCategory;

class UserHomeController extends Controller
{
    public function index()
    {
        $categories = RoomCategory::all();
        $facilities = Facility::all();

        $rooms = collect(); // Empty collection to show no rooms
        $roomNumbers = collect(); 

        // Pass categories, rooms, and facilities data to the view
        return view('home', compact('categories', 'rooms', 'facilities', 'roomNumbers'));
    }

    public function checkAvailability(Request $request)
    {
        $category = $request->input('category');
        $roomNo = $request->input('room_no');
        $facilities = $request->input('facilities', []);

        $query = Room::query();

        if ($category) {
            $query->where('room_category_id', $category);
        }

        if ($roomNo) {
            $query->where('room_no', $roomNo);
        }

        if (!empty($facilities)) {
            $query->whereHas('facilities', function ($q) use ($facilities) {
                $q->whereIn('facility_id', $facilities);
            });
        }

        $rooms = $query->get();

        $categories = RoomCategory::all();
        $facilities = Facility::all();

        $roomNumbers = $category ? Room::where('room_category_id', $category)->get(['id', 'room_no']) : collect();

        return view('home', compact('categories', 'rooms', 'facilities', 'roomNumbers'));
    }
}
