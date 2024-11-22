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
    // Display feedback submission form
    public function create()
    {
        return view('feedbacks.create');  // Create this view for feedback form
    }
    public function Index()
    {
        $feedbacks = Feedback::all();  // Retrieve all feedback

        return view('feedbacks.list', compact('feedbacks'));
    }


    // Store feedback in the database
    public function store(Request $request)
    {
        // Validate the feedback data
        $request->validate([
            'message' => 'required|string|max:500', // You can adjust the max length as needed
        ]);

        // Get the authenticated user's ID and email
        $user = Auth::user();

        // Create the feedback record in the database
        $feedback = Feedback::create([
            'user_id' => $user->user_id, // Assuming `user_id` is the primary key
            'email' => $user->email,     // You may or may not need to store email, adjust as needed
            'message' => $request->input('message'),
        ]);

        // Send notification to the admin (only if admin exists)
        $admin = Admin::first(); // Assuming 'role' is how you identify the admin
        if ($admin) {
            Log::info('Sending feedback notification to admin.');

            $admin->notify(new FeedbackNotification($feedback)); // Send notification to the admin
        }

        // Redirect back to the contact page with success message
        return redirect()->route('contact')->with('success', 'Feedback submitted successfully!');
    }
}
