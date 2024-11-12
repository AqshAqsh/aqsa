<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AdminController extends Controller
{
    public function showLoginForm(): \Illuminate\View\View
    {
        return view('admin.login');
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
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('status', 'Admin successfully logged out.');
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
}
