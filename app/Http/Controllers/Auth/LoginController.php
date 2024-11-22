<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function __construct()
    {
        // Ensure only guests can access the login form, except logout actions
        $this->middleware('guest')->except(['logout', 'userLogout']);
    }

    // Display the user login form
    public function showLoginForm(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Add validation and authentication logic for users here
        if (Auth::guard('web')->attempt($request->only('user_id', 'password'))) {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors('Login failed');
    }
    // Handle user logout
    public function userLogout(Request $request)
    {
        // Log out the current user
        Auth::logout();

        // Invalidate only the current session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
