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


    public function adminFunctionality()
    {
        return response()->json(['message' => 'Admin functionality accessed']);
    }


    //user methods
    public function showRooms()
    {
        $categories = RoomCategory::all();
        $facilities = Facility::all();

        // Get the rooms with related data
        $rooms = Room::with(['category', 'facilities', 'beds'])
            ->whereHas('beds', function ($query) {
                $query->where('is_occupied', 0);  // Check for beds that are not occupied
            })
            ->latest()
            ->get();

        $booking = Booking::where('user_id', auth()->id())->first();


        // Pass selectedRoom as null for the default view
        $selectedRoom = null;

        return view('rooms', compact('categories', 'rooms', 'facilities', 'booking', 'selectedRoom'));
    }

    public function userBooking(Request $request)
    {
        return response()->json(['message' => 'Booking successful']);
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


    public function getRoomsByCategory($categoryId)
    {
        // Fetch rooms for the selected category
        $rooms = Room::where('room_category_id', $categoryId)->get(['room_no']);
        return response()->json(['rooms' => $rooms]);
    }
    public function getRoomDetails($roomNo)
    {
        // Fetch room details including block and beds
        $room = Room::with(['block', 'beds'])->where('room_no', $roomNo)->first();

        if ($room) {
            $blockName = $room->block ? $room->block->block_name : '';
            $beds = $room->beds;

            // Return the details as JSON
            return response()->json([
                'block_name' => $blockName,
                'beds' => $beds
            ]);
        }

        return response()->json(['error' => 'Room not found'], 404);
    }

    public function filterRooms(Request $request)
    {
        $category = $request->input('category');
        $roomNo = $request->input('room_no');
        $status = $request->input('status');

        // Fetch the categories and facilities
        $categories = RoomCategory::all();
        $facilities = Facility::all();

        // Build the query for rooms
        $query = Room::with(['block', 'beds']); // Eager load block and beds relationships

        if ($category) {
            $query->where('room_category_id', $category);
        }

        if ($roomNo) {
            $query->where('room_no', $roomNo);
        }

        // Get the filtered rooms
        $rooms = $query->get();

        // Fetch room numbers based on the selected category (to populate the dropdown)
        $roomNumbers = $category ? Room::where('room_category_id', $category)->get(['room_no']) : [];

        $roomAvailability = $rooms->map(function ($room) {
            // Check if there are any beds available (where 'is_occupied' is false)
            $availableBeds = $room->beds->where('is_occupied', 0);
            $room->isAvailable = $availableBeds->isNotEmpty();
            return $room;
        });

        // Handle selected room and related data
        $selectedRoom = null;
        $roomBeds = [];

        if ($roomNo) {
            // Get the selected room based on room_no
            $selectedRoom = Room::with(['block', 'beds'])->where('room_no', $roomNo)->first();

            // Get the beds for the selected room
            if ($selectedRoom) {
                $roomBeds = $selectedRoom->beds; // Assuming the 'beds' relationship is defined correctly in the Room model
            }
        }

        return view('rooms', compact('categories', 'facilities', 'rooms', 'selectedRoom', 'roomNumbers', 'roomBeds', 'roomAvailability'));
    }
}
