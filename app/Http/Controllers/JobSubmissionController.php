<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobSubmission;
use App\Notifications\JobSubmissionNotification;

class JobSubmissionController extends Controller
{
    public function create()
    {
        return view('job_submission.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'description' => 'required',
        ]);

        // Check if it's the first submission by this email
        $firstSubmission = !JobSubmission::where('email', $request->email)->exists();

        // Save the job submission
        $jobSubmission = JobSubmission::create([
            'email' => $validatedData['email'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'first_submission' => $firstSubmission,
        ]);

        // Notify moderator if it's the first submission
        if ($firstSubmission) {
            $moderatorEmail = 'deguzmanpaulchristian@gmail.com'; // Replace with actual moderator email
            \Notification::route('mail', $moderatorEmail)->notify(new JobSubmissionNotification($jobSubmission));
        }

        return redirect()->back()->with('success', 'Job submitted successfully!');
    }
}
