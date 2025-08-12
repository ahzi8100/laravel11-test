<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-sm p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🔐 Register</h2>

        @if (session('error'))
            <div class="mb-4 text-red-600 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('register.user') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="name" id="name" name="name" value="{{ old('name') }}" required autofocus
                    class="mt-1 py-4 px-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 py-4 px-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 py-4 px-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Login -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Masuk
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <p>Have an account? <a href="{{ route('login') }}" class="text-blue-500 underline">Login here!</a></p>
        </div>
    </div>

</body>

</html>
