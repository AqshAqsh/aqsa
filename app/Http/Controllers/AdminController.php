<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function authenticate(Request $request){
        $this->validate($request , [
            'email' => 'required|email',
            'password' => 'required' 
        ]);

        if(Auth::guard('admin')->attempt(['email' =>$request->email, 'password' => $request->password ], $request->get('remember'))){
            return redirect()->route('admin.dashboard')->with('Hey! Admin You are logged in!');

        } else{
            session()->flash('error', 'Either Email or password incorrect');
            return back()->withInput($request->only('email'));
        }
    }
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('status', 'Successfully logged out!'); 
    }

    public function store(Request $request)
        {
            // Generate a unique User ID using a custom format
            $userID = 'USER-' . strtoupper(Str::random(8));

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user', // Assuming 'user' role by default
                'user_id' => $userID, // Assign the generated user_id
            ]);

            return redirect('/admin/users')->with('success', 'User created successfully with User ID: ' . $userID);
        }
}
