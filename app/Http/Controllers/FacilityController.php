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
        $rooms = Room::all();
        return view('admin.facility.create', compact('rooms'));
    }

    public function store(Request $request)
    {
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

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('facility_icons', 'public');
        }

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
        $facility = Facility::with('rooms')->findOrFail($id);
        $rooms = Room::all(); 
        return view('admin.facility.update', compact('facility', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        // Retrieve the facility
        $facility = Facility::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:3072',
            'room_ids' => 'required|array',
            'room_ids.*' => 'exists:rooms,id'
        ], [
            'name.required' => 'The facility name is required.',
            'room_ids.required' => 'Please select at least one room.',
        ]);

        if ($request->hasFile('icon')) {
            if ($facility->icon) {
                Storage::disk('public')->delete($facility->icon);
            }
            $facility->icon = $request->file('icon')->store('facility_icons', 'public');
        }

        $facility->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->has('room_ids')) {
            $facility->rooms()->sync($request->room_ids);
        }

        return redirect()->route('admin.facility.list')->with('success', 'Facility updated successfully.');
    }


    public function delete(Facility $facility)
    {
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
