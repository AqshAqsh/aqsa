<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\FeedbackNotification;

class FeedbackController extends Controller
{
    public function contact()
    {
        $user = Auth::user();
        return view('contact', compact('user'));
    }
    public function create()
    {
        return view('feedbacks.create');  
    }
    public function Index()
    {
        $feedbacks = Feedback::latest()->get();  

        return view('feedbacks.list', compact('feedbacks'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500', 
        ]);

        $user = Auth::user();

        $feedback = Feedback::create([
            'user_id' => $user->user_id, 
            'email' => $user->email,     
            'message' => $request->input('message'),
        ]);

        // Send notification to the admin (only if admin exists)
        $admin = Admin::first(); 
        if ($admin) {
            Log::info('Sending feedback notification to admin.');

            $admin->notify(new FeedbackNotification($feedback)); 
        }

        return redirect()->route('contact')->with('success', 'Feedback submitted successfully!');
    }
}
