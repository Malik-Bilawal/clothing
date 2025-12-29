<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-sm bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Admin Login</h2>

        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                >
            </div>

            @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror

            <button 
                type="submit" 
                class="w-full bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700 transition duration-200"
            >
                Login
            </button>
        </form>
    </div>

</body>
</html>
