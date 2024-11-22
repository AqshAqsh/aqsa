<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Room;
use App\Models\Feedback;


class AdminController extends Controller
{

    public function showLoginForm()
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }
    public function updateFeedbackStatus(Request $request, $feedbackId)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
        ]);

        // Find the feedback by ID
        $feedback = Feedback::findOrFail($feedbackId);

        // Update the status
        $feedback->status = $request->input('status');
        $feedback->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Feedback status updated successfully!');
    }
    public function showProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        // Get the currently authenticated admin
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the admin details
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');

        // Check if a profile picture is uploaded
        if ($request->hasFile('profile_picture')) {
            $profilePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $admin->profile_picture = $profilePath;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->input('password'));
        }

        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully.');
    }


    // Handle admin authentication
    public function authenticate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Define credentials
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the admin
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication successful, redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // Authentication failed, redirect back with error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Handle admin logout
    public function adminlogout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('status', 'Admin successfully logged out.');
    }
    public function Index()
    {
        $feedbacks = Feedback::all();  // Retrieve all feedback

        return view('feedbacks.index', compact('feedbacks'));
    }

    // Store a new user
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate a unique User ID using a custom format
        $userID = 'USER-' . strtoupper(Str::random(8));

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'user_id' => $userID,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'User created successfully with User ID: ' . $userID);
    }
    public function view()
    {
        $filePath = public_path('docs/Hostel.pdf');

        // Check if the file exists
        if (file_exists($filePath)) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="Hostel.pdf"',
            ]);
        } else {
            abort(404, 'Documentation not found');
        }
    }
}
