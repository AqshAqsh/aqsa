<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\LoginIdReminderMail;



class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'userLogout']);
    }

    public function showLoginForm(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'user_id' => 'required|string|exists:users,user_id',  // Check if user_id exists in the users table
        ]);

        // Retrieve the user using user_id
        $user = User::where('user_id', $request->input('user_id'))->first();

        // Check if the user exists
        if ($user) {
            // Log the user in
            Auth::login($user);

            // Redirect to the desired page after successful login
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }

        // If user not found, return back with an error message
        return back()->withErrors(['user_id' => 'Invalid User ID.']);
    }
    public function userLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged-out successfully!');
    }

    public function showForgotIdForm()
    {
        return view('auth.forgot_user_id');
    }

    public function processForgotId(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            Mail::to($user->email)->send(new \App\Mail\LoginIdReminderMail($user));

            return back()->with('status', 'If your email is registered, your Login ID has been sent to you.');
        }

        return back()->with('error', 'No account found with this email.');
    }
}
