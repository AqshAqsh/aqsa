<?php

namespace App\Http\Controllers\Admin\BedManager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Block;
use App\Models\Facility;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('category')->latest()->get();
        return view('admin.room.list', compact('rooms'));
    }

    public function create()
    {
        $room_categories = RoomCategory::latest()->get();
        return view('admin.room.create', compact('room_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_no' => 'required|unique:rooms',
            'room_category_id' => 'required|exists:room_categories,id',
            'room_charge' => 'required|numeric',
            'description' => 'nullable|string',
            'number_of_members' => 'nullable|integer',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Determine the block based on the room number
        $roomNo = (int)$request->room_no; // Convert to integer for comparison
        $blockId = null;
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('room_pictures', 'public');
        }

        // Fetch the block based on the room number
        if ($roomNo >= 201 && $roomNo <= 220) {
            $blockId = Block::where('block_name', 'A')->first()->id; // Assuming block names are 'A', 'B', etc.
        } elseif ($roomNo >= 221 && $roomNo <= 240) {
            $blockId = Block::where('block_name', 'B')->first()->id;
        } elseif ($roomNo >= 241 && $roomNo <= 260) {
            $blockId = Block::where('block_name', 'C')->first()->id;
        } elseif ($roomNo >= 261 && $roomNo <= 280) {
            $blockId = Block::where('block_name', 'D')->first()->id;
        } else {
            return response()->json(['error' => 'Room number is out of range.'], 400);
        }

        // Create the room
        Room::create([
            'room_no' => $request->room_no,
            'room_category_id' => $request->room_category_id,
            'block_id' => $blockId, // Use the fetched block ID
            'room_charge' => $request->room_charge,
            'description' => $request->description,
            'number_of_members' => $request->number_of_members,
            'picture' => $picturePath,
        ]);
        return redirect()->route('admin.room.list')->with('Success', 'Room successfully created');

        //return response()->json(['message' => 'Room created successfully.'], 201);
    }

    public function edit($id)
    {
        $room_categories = RoomCategory::latest()->get();
        $room = Room::findOrFail($id);
        return view('admin.room.update', compact('room_categories', 'room'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'room_no' => 'required|string|max:255',
            'room_category_id' => 'required|exists:room_categories,id',
            'description' => 'nullable|string',
            'room_charge' => 'required|integer|min:0', // Ensure it's treated as an integer
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $roomNumber = (int)$validate['room_no'];
        $blockId = null;

        if ($roomNumber >= 201 && $roomNumber <= 220) {
            $blockId = Block::where('block_name', 'A')->value('id');
        } elseif ($roomNumber >= 221 && $roomNumber <= 240) {
            $blockId = Block::where('block_name', 'B')->value('id');
        } elseif ($roomNumber >= 241 && $roomNumber <= 260) {
            $blockId = Block::where('block_name', 'C')->value('id');
        } elseif ($roomNumber >= 261 && $roomNumber <= 280) {
            $blockId = Block::where('block_name', 'D')->value('id');
        } else {
            return redirect()->back()->withErrors(['room_no' => 'Room number must be between 201 and 280.'])->withInput();
        }

        if (is_null($blockId)) {
            return redirect()->back()->withErrors(['block_id' => 'Invalid block identifier.'])->withInput();
        }

        $room = Room::findOrFail($id);
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('room_pictures', 'public');
            $validate['picture'] = $picturePath;
        }

        // Cast room_charge to an integer
        $validate['room_charge'] = (int)$validate['room_charge'];

        $room->update(array_merge($validate, [
            'block_id' => $blockId,
        ]));

        return redirect()->route('admin.room.list')->with('Success', 'Room successfully updated');
    }


    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.room.list')->with('Success', 'Room successfully deleted');
    }

    public function availableRooms()
    {
        $rooms = Room::where('available', true)->get();
        return response()->json($rooms);
    }

    public function getRoomsByCategory(Request $request)
    {
        $request->validate(['category_id' => 'required|exists:room_categories,id']);
        $categoryId = $request->query('category_id');
        $rooms = Room::where('room_category_id', $categoryId)->get();

        return response()->json(['rooms' => $rooms]);
    }


    public function adminFunctionality()
    {
        return response()->json(['message' => 'Admin functionality accessed']);
    }

    public function userBooking(Request $request)
    {
        return response()->json(['message' => 'Booking successful']);
    }

    public function showRooms()
    {

        $rooms = Room::with(['category', 'facilities', 'beds'])
            ->whereHas('beds', function ($query) {
                $query->where('is_occupied', 0);  // Check for beds that are not occupied
            })
            ->latest()
            ->get();
        $booking = Booking::where('user_id', auth()->id())->first();
        return view('rooms', compact('rooms', 'booking'));
    }

    public function showRoomDetails($id)
    {
        $room = Room::with('category')->withCount('beds')->findOrFail($id);
        return view('room.details', compact('room'));
    }

    public function showBookingForm($id)
    {
        $userId = Auth::id();
        $room = Room::with(['category', 'facilities'])->findOrFail($id);
        return view('room.booking', compact('userId', 'room'));
    }

    public function submitBooking(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|string',
            'booking_date' => 'required|date',
            'number_of_guests' => 'required|integer|min:1',
            'facilities' => 'array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        $booking = Booking::create([
            'user_id' => $request->user_id,
            'room_id' => $id,
            'booking_date' => $request->booking_date,
            'number_of_guests' => $request->number_of_guests,
        ]);

        if ($request->has('facilities')) {
            $booking->facilities()->attach($request->facilities);
        }

        return redirect()->route('booking.success');
    }

    public function showAvailabilityForm()
    {
        $categories = RoomCategory::all();
        $blocks = Block::all(); // Assuming you have a Block model
        $facilities = Facility::all();

        // Pass data to the view
        return view('home', compact('categories', 'blocks', 'facilities'));
    }


    public function checkAvailability(Request $request)
    {
        // Retrieve the selected filters
        $room_category = $request->input('category');
        $roomNo = $request->input('room_no');
        $selectedFacilities = $request->input('facilities', []);

        // Query to retrieve rooms based on the filters
        $query = Room::query();

        if ($room_category) {
            $query->where('room_category_id', $room_category);
        }

        if ($roomNo) {
            $query->where('room_no', $roomNo);
        }

        if (!empty($selectedFacilities)) {
            $query->whereHas('facilities', function ($q) use ($selectedFacilities) {
                $q->whereIn('facility_id', $selectedFacilities);
            });
        }

        // Retrieve the rooms that match the criteria
        $rooms = $query->get();

        // Fetch categories, blocks, and facilities from the database
        $categories = RoomCategory::all();  // Fetch categories here
        $facilities = Facility::all();  // Fetch facilities here

        // Pass data to the view
        return view('home', compact('categories', 'rooms', 'facilities'));
    }







    public function showavail(Room $room)
    {
        $blocks = Block::all();
        $facilities = Facility::all();

        // Initialize availableRooms as an empty collection if no filters are applied
        $availableRooms = Room::with(['block', 'beds', 'facilities'])->get();

        return view('rooms', compact('availableRooms', 'blocks', 'facilities'));
    }
    public function getRoomDetails($room_no)
    {
        $room = Room::with(['beds' => function ($query) {
            $query->where('status', 'available');
        }, 'facilities'])->where('room_no', $room_no)->first();

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        $availableBeds = $room->beds->pluck('status');  // Array of bed statuses
        $facilities = $room->facilities;

        return response()->json([
            'block_name' => $room->block->block_name,
            'availableBeds' => $availableBeds,
            'facilities' => $facilities,
        ]);
    }
    public function getRoomBlock($roomNo)
    {
        $room = Room::where('room_no', $roomNo)->first();
        return response()->json(['block_name' => $room->block->block_name]);
    }

    public function getAvailableBeds($roomNo)
    {
        $room = Room::where('room_no', $roomNo)->first();
        $beds = $room->beds()->where('is_occupied', 0)->get(); // assuming `is_occupied` indicates if the bed is free
        return response()->json(['beds' => $beds]);
    }




    public function roo()
    {
        // Fetch any necessary data for the form (e.g., building blocks, facilities)
        $blocks = \App\Models\Block::all();
        $facilities = \App\Models\Facility::all();

        // Load the search form view
        return view('rooms.roo', compact('blocks', 'facilities'));
    }
}
