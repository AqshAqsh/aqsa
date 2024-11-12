<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function contact()
    {
        $user = Auth::user();  // Get the authenticated user
        return view('contact', compact('user'));  // Pass the 'user' data to the view
    }



    // Display feedback submission form
    public function create()
    {
        return view('feedback.create');  // Create this view for feedback form
    }

    // Store feedback in the database
    public function store(Request $request)
    {
        // Validate the feedback data
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        // Get the authenticated user’s user_id and email
        $user = Auth::user();

        // Create the feedback
        Feedback::create([
            'user_id' => $user->user_id,
            'email' => $user->email,
            'message' => $request->input('message'),
        ]);

        return redirect()->route('contact')->with('success', 'Feedback submitted successfully!');
    }
}
