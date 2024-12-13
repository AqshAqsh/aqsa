<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $categories = RoomCategory::all();
        $facilities = Facility::all();

        $rooms = collect(); // Empty collection to show no rooms
        $roomNumbers = collect();

        return view('welcome', compact('categories', 'rooms', 'facilities', 'roomNumbers'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


}
