<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->get();
        return view('admin.member.list', compact('members'));
    }
    public function create()
    {
        return view('admin.member.create');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'username' => 'required',
            'dob' => 'required|date',
            'religion' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'guardian_number' => 'required',
            'guardian_name' => 'required',
            'guardian_relation' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
        ]);
        $validate['image'] = $request->file('image')->store('member', 'public');
        Member::create($validate);
        return redirect()->route('admin.member.list')->with('Success', 'member record sucessfully added');
    }
    public function edit($id)
    {
        $members = Member::findOrFail($id);
        return view('admin.member.update', compact('members'));
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
            'username' => 'required',
            'dob' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'guardian_number' => 'required',
            'guardian_name' => 'required',
            'guardian_relation' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:1024',
        ]);
        $member = Member::findOrFail($id);
        if ($request->file('image')) {
            $validate['image'] = $request->file('image')->store('member', 'public');
        } else {
            $validate['image'] = $member->image;
        }
        $member->update($validate);

        return redirect()->route('admin.member.list')->with('Success', 'member record sucessfully updated');
    }
    public function delete($id)
    {
        Member::destroy($id);
        return redirect()->route('admin.member.list')->with('Success', 'member record sucessfully deleted');
    }
}
