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
        $request->validate([
            'user_id' => 'required|string',
            'email' => 'required|email', 
        ]);

        $user = User::where('user_id', $request->input('user_id'))
            ->where('email', $request->input('email'))
            ->first();

        if ($user) {
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }

        return redirect()->back()->withErrors([
        'error' => 'Either email or user_id is incorrect.',
        ]);
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
