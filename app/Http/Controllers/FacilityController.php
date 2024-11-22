<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        // Fetch all facilities with their associated rooms
        $facilities = Facility::with('rooms')->get();
        return view('admin.facility.list', compact('facilities'));
    }
    public function facilitiesview()
    {
        // Fetch all facilities for the public view
        $facilities = Facility::latest()->get();
        return view('facilities', compact('facilities'));
    }


    public function create()
    {
        // Retrieve rooms to populate the dropdown
        $rooms = Room::all();
        return view('admin.facility.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'room_ids' => 'required|array',
            'room_ids.*' => 'exists:rooms,id'
        ], [
            'name.required' => 'The facility name is required.',
            'room_ids.required' => 'Please select at least one room.',
        ]);

        // Handle icon upload
        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('facility_icons', 'public');
        }

        // Create the facility
        $facility = Facility::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $iconPath
        ]);

        // Attach selected rooms to the facility
        if ($facility) {
            $facility->rooms()->attach($request->room_ids);
        }

        return redirect()->route('admin.facility.list')->with('success', 'Facility created successfully.');
    }

    public function edit($id)
    {
        // Fetch the facility and rooms for the edit form
        $facility = Facility::with('rooms')->findOrFail($id);
        $rooms = Room::all(); // Retrieve all rooms to populate the dropdown
        return view('admin.facility.update', compact('facility', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        // Retrieve the facility
        $facility = Facility::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'room_ids' => 'required|array',
            'room_ids.*' => 'exists:rooms,id'
        ], [
            'name.required' => 'The facility name is required.',
            'room_ids.required' => 'Please select at least one room.',
        ]);

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete the old icon if it exists
            if ($facility->icon) {
                Storage::disk('public')->delete($facility->icon);
            }
            // Store the new icon
            $facility->icon = $request->file('icon')->store('facility_icons', 'public');
        }

        // Update facility details
        $facility->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Sync associated rooms
        if ($request->has('room_ids')) {
            $facility->rooms()->sync($request->room_ids);
        }

        return redirect()->route('admin.facility.list')->with('success', 'Facility updated successfully.');
    }


    public function delete(Facility $facility)
    {
        // Delete facility and its icon if it exists
        if ($facility->icon) {
            Storage::disk('public')->delete($facility->icon);
        }

        // Detach associated rooms
        $facility->rooms()->detach();

        // Delete the facility
        $facility->delete();
        return redirect()->route('admin.facility.list')->with('success', 'Facility deleted successfully.');
    }

}
