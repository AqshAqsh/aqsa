<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Notices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;

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
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|string|in:user,admin', // Ensure role is validated
        ]);

        // Create new user instance
        $user = new User();
        $user->user_id = 'USER-' . strtoupper(Str::random(8)); // Generate unique user_id
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();

        // Send email to user with the generated user_id
        Mail::to($user->email)->send(new UserCreatedMail($user->user_id)); // Pass the whole user object

        // Redirect with success message
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
            'role' => 'required|string|in:user,admin',
        ]);

        $user = User::where('user_id', $user_id)->firstOrFail();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

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


    public function showProfile()
    {
        $user = auth()->user();
        $currentYear = date('Y');
        $enrollmentYear = $user->enrollment_year;

        // Calculate years since enrollment
        $yearsSinceEnrollment = $currentYear - $enrollmentYear;
        $semesters = ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4'];

        // Pass this data to the view
        return view('profile', compact('user', 'yearsSinceEnrollment','semesters'));
    }


    public function updateProfile(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'full_name' => 'required|string|max:255|regex:/^[\S\s]+$/',  // Ensures no space character allowed
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date|before:-18 years',  // Ensures user is at least 18 years old
            'contact_number' => 'required|regex:/^[0-9]{11}$/|min:11|max:11',
            'permanent_address' => 'required|string',
            'current_address' => 'required|string',
            'college_roll_number' => 'required|string',
            'college_department' => 'required|string',
            'semester' => 'required|string',
            'program' => 'required|string',
            'enrollment_year' => 'required|string',
            'room_number' => 'nullable|integer',
            'hostel_block' => 'nullable|string',
            'bed_number' => 'nullable|string',
            'guardian_name' => 'required|string',
            'guardian_contact_number' => 'required|regex:/^[0-9]{11}$/|min:11|max:11',
            'guardian_address' => 'required|string',
            'user_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Make 'user_picture' nullable to allow updates without an image
        ], [
            'date_of_birth.before' => 'You must be at least 18 years old.',
            'college_roll_number.unique' => 'This roll number has already been taken.',
            'enrollment_year.between' => 'Enrollment year must be between 2000 and the current year.',
        ]);

        $birthDate = Carbon::parse($request->date_of_birth);
        $age = Carbon::now()->diffInYears($birthDate);
        if ($age < 18) {
            return back()->withErrors(['date_of_birth' => 'You must be at least 18 years old.']);
        }

        $user = auth()->user();

        // Handle image upload
        if ($request->hasFile('user_picture')) {
            // Store the new image and get the path
            $path = $request->file('user_picture')->store('user_pictures', 'public');
            $imagePath = str_replace('public/', '', $path); // Remove the 'public/' prefix to store the path correctly
        } else {
            // If no new image is uploaded, preserve the old image path
            $imagePath = $user->user_picture;
        }

        // Update the user profile
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
            'guardian_address'
        ]));

        $user->update([
            'user_picture' => $imagePath,
        ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }





    public function showNotice()
    {
        $user = auth()->user();
        $notice = $user->notice;
        $activeNotices = Notices::active()->get();

        return view('notice', compact('user', 'notice', 'activeNotices'));
    }

    public function markAsRead($noticeId)
    {
        $notice = Auth::user()->notifications()->where('id', $noticeId)->first();

        if ($notice) {
            $notice->markAsRead();
            return back()->with('success', 'Notification marked as read.');
        }

        return back()->with('error', 'Notification not found.');
    }
}
