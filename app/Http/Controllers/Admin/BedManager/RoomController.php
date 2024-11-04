<?php

namespace App\Http\Controllers\Admin\BedManager;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();
        return view('admin.room.list', compact('rooms'));
    }
    public function create()
    {
        $room_categorys = RoomCategory::latest()->get();
        return view('admin.room.create', compact('room_categorys'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'room_no' => 'required',
            'room_category_id' => 'required',
            'description' => 'required',
            'room_charge' => 'required',
        ]);
        Room::create($validate);
        return redirect()->route('admin.room.list')->with('Success', 'Room sucessfully created');
    }


    public function edit($id)
    {
        $room_categorys = RoomCategory::latest()->get();
        $room = Room::findOrFail($id);
        return view('admin.room.update', compact('room_categorys', 'room'));
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'room_no' => 'required',
            'room_category_id' => 'required',
            'description' => 'required',
            'room_charge' => 'required',
        ]);
        Room::findOrFail($id)->update($validate);
        return redirect()->route('admin.room.list')->with('Success', 'Room sucessfully updted');
    }
    public function delete($id)
    {
        Room::findOrFail($id)->delete();
        return redirect()->route('admin.room.list')->with('Success', 'Room sucessfully deleted');
    }
}
