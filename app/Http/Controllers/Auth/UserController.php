<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.list', compact('users'));
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
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|string|in:user,admin', // Ensure role is validated
        ]);

        // Create the new user
        $user = new User();
        $user->user_id = 'USER-' . strtoupper(Str::random(8)); // Adjust this if needed
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Use Hash::make for password
        $user->role = $request->input('role'); // Set the role
        $user->save();

        return redirect()->route('admin.user.list')->with('success', 'User registered successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        return view('admin.user.edit', compact('user')); // Return the edit view
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6', // Optional for updating password
            'role' => 'required|string|in:user,admin', // Ensure role is validated
        ]);

        $user = User::findOrFail($id); // Find user by ID

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Only update password if provided
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password')); // Hash new password
        }

        $user->role = $request->input('role'); // Set the role
        $user->save();

        return redirect()->route('admin.user.list')->with('success', 'User updated successfully!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        $user->delete(); // Delete the user
        return redirect()->route('admin.user.list')->with('success', 'User deleted successfully!');
    }
    public function showProfile()
    {
        $user = auth()->user(); // Get logged-in user data
        return view('profile', compact('user'));
    }
    public function showinbox()
    {
        $user = auth()->user(); // Get logged-in user data
        return view('bookingrequestresponse', compact('user'));
    }
    public function markAsRead($notificationId)
{
    // Check if the user is authenticated
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You need to be logged in to perform this action.');
    }

    // Attempt to find the notification
    try {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Notification not found.');
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('Error marking notification as read: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while marking the notification as read.');
    }

    return redirect()->back()->with('success', 'Notification marked as read successfully.');
}
    public function updateProfile(Request $request)
    {
        // Validate input data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date',
            'contact_number' => 'required|regex:/^[0-9]{10}$/',
            'permanent_address' => 'required|string',
            'current_address' => 'required|string',
            'college_roll_number' => 'required|string',
            'college_department' => 'required|string',
            'semester' => 'required|string',
            'program' => 'required|string',
            'enrollment_year' => 'required|integer|between:2000,' . date('Y'),
            'room_number' => 'required|integer',
            'hostel_block' => 'required|string',
            'bed_number' => 'required|string',
            'guardian_name' => 'required|string',
            'guardian_contact_number' => 'required|regex:/^[0-9]{10}$/',
            'guardian_address' => 'required|string',
        ]);

        // Get the logged-in user
        $user = auth()->user();

        // Update only the allowed fields
        $user->update($request->only([
            'full_name',           
            'gender',           
            'date_of_birth',
            'contact_number',
            'permanent_address',
            'current_address',
            'college_roll_number',
            'college_department',
            'semester',
            'program',
            'enrollment_year',
            'room_number',
            'hostel_block',
            'bed_number',
            'guardian_name',
            'guardian_contact_number',
            'guardian_address',
            'relation_to_guardian',
        ]));

        // Redirect to the profile page with success message
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
