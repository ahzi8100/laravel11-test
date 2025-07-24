<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogs Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Trashed Blog</h1>

        <div class="mb-5">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-5">Blog Title</label>
            @foreach ($blogs as $blog)
                <div class="flex items-center justify-between gap-3">
                    <span class="p-3  w-full">{{ $blog->title }}</span>

                    <a href="{{ route('blogs.restore', ['id' => $blog->id]) }}"
                        class="text-sm text-gray-600 hover:underline px-4 py-2 rounded border border-yellow-400 hover:bg-yellow-400 hover:text-white">
                        Restore
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Buttons -->
        <a href="{{ route('blogs.index') }}"
            class="mt-10 bg-gray-100 text-sm text-gray-600 hover:underline px-4 py-2 rounded border border-gray-400 hover:bg-gray-400 hover:text-white">
            Back
        </a>
    </div>
</body>

</html>
