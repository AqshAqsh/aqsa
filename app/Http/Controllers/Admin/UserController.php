<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {

        $user = User::all();
        $data = compact('user');
        return view('admin.user.list')->with($data);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'email' => 'required|email|max:255|unique:users,email', // Assuming the table is 'users', not 'students'
        ]);

        // Insert query
        $user = new User();

        // Generate a unique user ID
        $user->user_id = 'USER-' . strtoupper(Str::random(8)); // Adjust this if needed based on your user ID format
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Password hashed

        $user->save();
        return redirect()->route('admin.user.list')->with('success', 'User registered successfully!');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        if (!$user) {
            return redirect()->route('admin.user.list')->with('error', 'User not found.'); // Redirect if user not found
        }
        return redirect()->route('admin.user.update', compact('user')); // Pass the user to the edit view
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id, // Unique except for current user
            'password' => 'nullable|string|min:6', // Optional
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.user.list')->with('error', 'User not found.');
        }

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Only update password if it's provided
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password')); // Hash new password
        }

        $user->save();
        return redirect()->route('admin.user.list')->with('success', 'User updated successfully!');
    }
    public function delete($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        return redirect()->route('admin.user.list');
        //echo "<pre>";
        //print_r($user);

    }
}
