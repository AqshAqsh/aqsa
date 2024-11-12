<?php
namespace App\Http\Controllers\Admin\BedManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\RoomCategory;

class RoomCategoryController extends Controller
{
    public function index()
    {
        $room_categorys = RoomCategory::latest()->get();
        return view('admin.room_category.list', compact('room_categorys'));
    }
    public function create()
    {
        return view('admin.room_category.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:room_categories,name'
        ]);
        RoomCategory::create($validate);
        return redirect()->route('admin.room_category.list')->with('success', 'RoomCategory create successfully');
    }
    public function edit($id)
    {
        $room_categorys = RoomCategory::findOrFail($id);
        return view('admin.room_category.update', compact('room_categorys'));
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);
        RoomCategory::findOrFail($id)->update($validate);
        return redirect()->route('admin.room_category.list')->with('success', 'RoomCategory updates successfully');
    }

    public function delete($id)
    {
        RoomCategory::findOrFail($id)->delete();
        return redirect()->route('admin.room_category.list')->with('success', 'RoomCategory Delete successfully');
    }
}
