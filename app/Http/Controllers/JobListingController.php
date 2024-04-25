<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;
use App\Models\JobListing;
use App\Models\JobSubmission;

class JobListingController extends Controller
{
    public function index()
    {
        // Fetch job listings from external API
        $response = Http::get('https://mrge-group-gmbh.jobs.personio.de/xml');
        
        // Parse XML data
        $xml = new SimpleXMLElement($response->body());
        
        // Process each job listing
        foreach ($xml->job as $job) {
            $jobListing = new JobListing();
            $jobListing->title = (string) $job->title;
            $jobListing->description = (string) $job->description;
            // Add more fields if available in the XML
            $jobListing->save();
        }
        
        // Get all job listings
        $jobListings = JobSubmission::where('approved', true)->get();
        
        return view('job_listing.index', compact('jobListings'));
    }
}
