<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100 py-12 px-4">
    <div class="max-w-3xl mx-auto bg-white p-6 shadow-md rounded-md">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Job Listings</h1>
            <div>
                <a href="{{ route('job_submission.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md mr-2 hover:bg-blue-600">Submit Listing</a>
                <a href="{{ route('moderator.index') }}" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Moderator Page</a>
            </div>
        </div>
        
        <div class="grid gap-4">
            @foreach($jobListings as $jobListing)
            <div class="bg-gray-200 p-4 rounded-md shadow-md">
                <h2 class="text-lg font-semibold">{{ $jobListing->title }}</h2>
                <p class="text-gray-700">{{ $jobListing->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>