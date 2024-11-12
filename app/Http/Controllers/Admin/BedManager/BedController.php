<?php

namespace App\Http\Controllers\Admin\BedManager;

use App\Http\Controllers\Controller;
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
        // Define the maximum limit for beds per room
        $maxBedsPerRoom = 4;

        // Validate the request
        $validate = $request->validate([
            'bed_no' => 'required|integer|min:1|max:4', // Add max validation here
            'room_id' => 'required|exists:rooms,id', // Ensure room_id matches room_id in rooms table
            'description' => 'required|string|max:255',
        ]);

        // Get the current bed's room to check how many beds are currently in that room
        $currentBed = Bed::findOrFail($id);
        $currentRoomNo = $currentBed->room_id;

        // Check if the room is changing
        if ($currentRoomNo !== $validate['room_id']) {
            // Check if adding this bed exceeds the limit
            if (!$this->canAddMoreBeds($validate['room_id'], 1)) {
                return redirect()->back()->withErrors(['error' => 'Cannot add more beds. The maximum limit is ' . $maxBedsPerRoom . ' beds per room.']);
            }
        }

        // Update the bed record
        $currentBed->update($validate);

        // Update the number of members for the room if the room has changed
        if ($currentRoomNo !== $validate['room_id']) {
            // Update the old room's member count
            $oldRoom = Room::find($currentRoomNo);
            $oldRoom->number_of_members -= 1; // Decrease by 1 since this bed is removed from the old room
            $oldRoom->save();

            // Update the new room's member count
            $newRoom = Room::find($validate['room_id']);
            $newRoom->number_of_members += 1; // Increase by 1 since this bed is added to the new room
            $newRoom->save();
        }

        return redirect()->route('admin.bed.list')->with('success', 'Bed record successfully updated');
    }

    public function delete($id)
    {
        $bed = Bed::findOrFail($id);
        $room = Room::find($bed->room_id);

        // Decrease the number of members in the room
        $room->number_of_members -= 1;
        $room->save();

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
}