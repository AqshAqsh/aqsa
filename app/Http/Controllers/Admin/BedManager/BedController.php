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
        $validate = $request->validate([
            'bed_no' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'required'
        ]);
        Bed::create($validate);
        return redirect()->route('admin.bed.list')->with('Success', 'Bed rocord sucessfully added');
    }
    public function edit($id)
    {
        $bed = Bed::findOrFail($id);
        $rooms = Room::latest()->get();
        return view('admin.bed.update', compact('bed', 'rooms'));
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'bed_no' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'required',
        ]);
        Bed::findOrFail($id)->update($validate);
        return redirect()->route('admin.bed.list')->with('Success', 'Bed rocord sucessfully updated');
    }
    public function delete($id)
    {
        Bed::destroy($id);
        return redirect()->route('admin.bed.list')->with('Success', 'Bed rocord sucessfully deleted');
    }
}
