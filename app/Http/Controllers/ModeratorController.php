<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobSubmission;

class ModeratorController extends Controller
{
    public function index()
    {
        $submissions = JobSubmission::where('approved', false)->get();
        return view('moderator.index', compact('submissions'));
    }

    public function approve($id)
    {
        $submission = JobSubmission::findOrFail($id);
        // Approve logic goes here, for example, updating a field in the database
        $submission->update(['approved' => true]);
        return redirect()->route('moderator.index')->with('success', 'Job submission approved!');
    }

    public function disapprove($id)
    {
        $submission = JobSubmission::findOrFail($id);
        // Disapprove logic goes here, for example, deleting the submission or marking it as disapproved
        $submission->delete(); // You can customize this according to your needs
        return redirect()->route('moderator.index')->with('success', 'Job submission disapproved!');
    }
}
