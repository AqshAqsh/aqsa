<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
       return view('auth.login');
    }

    protected $redirectTo = '/home1';

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'userLogout']);
    }

    public function login(Request $request)
    //$this->validateLogin($request);
    {
        // Validate the login credentials
        $request->validate([
            'user_id' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (auth()->attempt(['user_id' => $request->user_id, 'email' => $request->email, 'password' => $request->password])) {
            // Redirect to intended page or a default page
            return redirect()->intended('home1')->with('status', 'Successfully logged in!'); // Redirect to home1 or any intended route
        }

        // If the login attempt was unsuccessful, redirect back to the login form with an error
        return back()->withInput($request->only('user_id', 'email'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }



    protected function validateLogin(Request $request)
    {
        $request->validate([
            'user_id' => 'required_without:email',
            'email' => 'required_without:user_id|email',
            'password' => 'required|string',
            'role' => 'required|string|in:admin,user', // Ensure this field is available in your form
        ]);
    }

    protected function credentials(Request $request)
    {
        if ($request->role === 'admin') {
            return [
                'email' => $request->email,
                'password' => $request->password,
            ];
        } else {
            return [
                'user_id' => $request->user_id,
                'password' => $request->password,
            ];
        }
    }


    protected function attemptLogin(Request $request)
    {
        if (!Auth::attempt($this->credentials($request))) {
            Log::error("Login failed for user with credentials:", [
                'request' => $request->all(),
                'credentials' => $this->credentials($request)
            ]);
            return false;
        }
        return true;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('user_id', 'email'))
            ->withErrors([
                'login' => 'The provided credentials do not match our records.', // Generic error for login failure
            ]);
    }

    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('status', 'Successfully logged out!');
    }
}
