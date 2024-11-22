<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Notices;

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
        $user->user_id = 'USER-' . strtoupper(Str::random(8)); // Generate unique user_id
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Hash the password
        $user->role = $request->input('role'); // Set the role
        $user->save();

        return redirect()->route('admin.user.list')->with('success', 'User registered successfully!');
    }

    public function edit($user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail(); // Find user by user_id
        return view('admin.user.update', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user_id . ',user_id',
            'password' => 'nullable|string|min:6', // Optional for updating password
            'role' => 'required|string|in:user,admin', // Ensure role is validated
        ]);

        $user = User::where('user_id', $user_id)->firstOrFail(); // Find user by user_id

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Only update password if provided
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('admin.user.list')->with('success', 'User updated successfully!');
    }

    public function delete($user_id)
    {
        $user = User::where('user_id', $user_id)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('admin.user.list')->with('success', 'User deleted successfully!');
        }

        return redirect()->route('admin.user.list')->with('error', 'User not found');
    }

    public function showNotice()
    {
        $user = auth()->user();
        $notifications = $user->notifications; // Fetch all notifications for the logged-in user
        $activeNotices = Notices::active()->get(); // Get active notices

        // Pass the correct variable to the view
        return view('notice', compact('user', 'notifications', 'activeNotices'));
    }

    public function showProfile()
    {
        $user = auth()->user(); // Get logged-in user data
        return view('profile', compact('user'));
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

        // Get the logged-in user and explicitly type hint it
        /** @var \App\Models\User $user */
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
    public function showNotifications()
    {
        // Fetch notifications for the authenticated user
        $notifications = Auth::user()->notifications;

        // Return view with notifications data
        return view('notifications', compact('notifications'));
    }


    public function markAsRead($notificationId)
    {
        // Get the notification by ID
        $notification = Auth::user()->notifications()->where('id', $notificationId)->first();

        // If the notification exists, mark it as read
        if ($notification) {
            $notification->markAsRead();
            return back()->with('success', 'Notification marked as read.');
        }

        // If notification is not found
        return back()->with('error', 'Notification not found.');
    }
}
