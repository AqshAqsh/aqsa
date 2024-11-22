<?php

namespace App\Http\Controllers\Admin\BedManager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bed;
use App\Models\Room;

class BedController extends Controller
{
    public function index()
    {
        $beds = Bed::latest()->get();
        return view('admin.bed.list', compact('beds'));
    }

    public function create()
    {
        $rooms = Room::latest()->get();
        return view('admin.bed.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validate = $request->validate([
            'bed_no' => 'required|integer|min:1|max:4', // Number of beds to add (max 4)
            'room_id' => 'required|exists:rooms,id', // Ensure room_id matches room_id in rooms table
            'description' => 'required|string|max:255'
        ]);

        // Check if adding the requested number of beds exceeds the limit
        if (!$this->canAddMoreBeds($validate['room_id'], $validate['bed_no'])) {
            return redirect()->back()->withErrors(['error' => 'Cannot add more beds. The maximum limit is 4 beds per room.']);
        }

        // Create multiple bed records based on bed_no
        $currentBedCount = Bed::where('room_id', $validate['room_id'])->count();
        for ($i = 0; $i < $validate['bed_no']; $i++) {
            Bed::create([
                'bed_no' => "Bed No " . ($currentBedCount + $i + 1), // Unique bed number
                'room_id' => $validate['room_id'],
                'description' => $validate['description'],
            ]);
        }

        // Update the number of members for the room
        $room = Room::find($validate['room_id']);
        $room->number_of_members += $validate['bed_no']; // Increase by the number of beds added
        $room->save();

        return redirect()->route('admin.bed.list')->with('success', 'Bed records successfully added');
    }

    public function edit($id)
    {
        $bed = Bed::findOrFail($id);
        $rooms = Room::latest()->get();
        return view('admin.bed.update', compact('bed', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        // Validate only description as bed_no and room_id are not editable
        $validate = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        // Find the bed to update
        $bed = Bed::findOrFail($id);

        // Update the description only
        $bed->update($validate);

        return redirect()->route('admin.bed.list')->with('success', 'Bed record successfully updated');
    }

    public function delete($id)
    {
        $bed = Bed::findOrFail($id);

        // Check if the bed is occupied
        if ($bed->is_occupied) {
            return redirect()->route('admin.bed.list')->with('error', 'This bed is currently occupied and cannot be deleted.');
        }

        // Check if there is an active booking for this bed (booking exists but not occupied)
        $booking = $bed->booking()->where('status', 'pending')->first();  // Assuming 'status' column tracks booking requests

        if ($booking) {
            return redirect()->route('admin.bed.list')->with('error', 'A booking request is made for this bed. Please reject the booking request first before deleting the bed.');
        }

        // Check if the bed has an associated room and reduce the number of members
        $room = Room::find($bed->room_id);
        if ($room) {
            $room->number_of_members -= 1;  // Decrease by one bed
            $room->save();
        }

        // Delete the bed record
        Bed::destroy($id);

        return redirect()->route('admin.bed.list')->with('success', 'Bed record successfully deleted');
    }



    private function canAddMoreBeds($roomId, $additionalBeds)
    {
        $currentBedCount = Bed::where('room_id', $roomId)->count();
        $newBedCount = $currentBedCount + $additionalBeds;
        $maxBedsPerRoom = 4;

        return $newBedCount <= $maxBedsPerRoom;
    }
    public function assign($bedId)
    {
        $bed = Bed::find($bedId);

        if (!$bed) {
            return redirect()->back()->with('error', 'Bed not found.');
        }

        // Proceed with the assignment logic
        $bed->is_occupied = true;
        $bed->user_id = Auth::id();  // Assuming you want to assign the bed to the current logged-in admin user
        $bed->save();

        return redirect()->route('admin.beds.assigned')->with('success', 'Bed successfully assigned.');
    }
}
