<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notices;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error\Notice;
use Symfony\Contracts\Service\Attribute\Required;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notices::latest()->get();
        return view('admin.notice.list', compact('notices'));
    }
    public function create()
    {
        return view('admin.notice.create');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'Required',
            'date' => 'Required',
            'content' => 'Required',
        ]);
        Notices::create($validate);

        return redirect()->route('admin.notice.list')->with('success','Notice create successfully');
    }
    public function edit($id){
        $notices=Notices::findOrFail($id);
        return view('admin.notice.update', compact('notices'));
        
    }
    public function update(Request $request,$id)
    {
        $validate = $request->validate([
            'title' => 'Required',
            'date' => 'Required',
            'content' => 'Required',
        ]);
        Notices::findOrFail($id)->update($validate);

        return redirect()->route('admin.notice.list')->with('success','Notice update successfully');
    }
    public function delete(Request $request,$id)
    {
        Notices::destroy($id);

        return redirect()->route('admin.notice.list')->with('success','Notice deleted successfully');
    }
}
