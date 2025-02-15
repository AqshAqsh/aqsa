<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Room;
use App\Models\Feedback;
use App\Notifications\FeedbackStatusUpdated;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;




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
        $user = $feedback->user;

        // Send a notification to the user
        $user->notify(new FeedbackStatusUpdated($feedback, $feedback->status));

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


    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withInput()->withErrors([
            'error' => 'Either email or password is incorrect.',
        ]);
    }

    public function adminlogout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('admin')->logout();
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

    public function view()
    {
        $filePath = public_path('docs/ResideMe.pdf');

        // Check if the file exists
        if (file_exists($filePath)) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="ResideMe.pdf"',
            ]);
        } else {
            abort(404, 'Documentation not found');
        }
    }
}
