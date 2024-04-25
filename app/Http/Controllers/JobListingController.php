<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;
use App\Models\JobListing;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        // Fetch job listings from external API
        $response = Http::get('https://mrge-group-gmbh.jobs.personio.de/xml');
        
        // Parse XML data
        $xml = new SimpleXMLElement($response->body());

        // Process each job listing
        foreach ($xml->position as $job) {
            $checker = JobListing::where('title', $job->name)->get();
            if($checker->count() <= 0){
                $jobListing = new JobListing();
                $jobListing->title = (string) $job->name;
                $jobListing->description = (string) $job->recruitingCategory;
                $jobListing->qualification = (string) $job->yearsOfExperience;
                $jobListing->location = (string) $job->office;
                $jobListing->department = (string) $job->department;
                $jobListing->save();
            }
        }
        
        // Filter job listings based on search query if provided
        $query = $request->input('search');
        $jobListings = JobListing::query();
        if ($query) {
            $jobListings->where('title', 'like', '%' . $query . '%');
        }
        
        // Get all job listings
        $jobListings = $jobListings->get();
        
        return view('job_listing.index', compact('jobListings'));
    }
}
