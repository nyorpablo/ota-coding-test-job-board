<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100 py-12 px-4">
    <div class="max-w-3xl mx-auto bg-white p-6 shadow-md rounded-md">
        <h1 class="text-2xl font-semibold mb-6">Moderator Dashboard</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid gap-4">
            @foreach($submissions as $submission)
                <div class="bg-gray-200 p-4 rounded-md shadow-md">
                    <h2 class="text-lg font-semibold">{{ $submission->title }}</h2>
                    <p class="text-gray-700">{{ $submission->description }}</p>
                    <div class="mt-2 flex">
                        <form action="{{ route('moderator.approve', $submission->id) }}" method="post" class="mr-2">
                            @csrf
                            @method('put')
                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Approve</button>
                        </form>
                        <form action="{{ route('moderator.disapprove', $submission->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Disapprove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>