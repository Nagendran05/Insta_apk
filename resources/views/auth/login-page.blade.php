<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="shortcut icon" href="https://dreamfoundry.org/wp-content/uploads/2018/12/instagram-logo-png-transparent-background.png" type="image/x-icon">
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class=" p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-6">Instagram</h2>

            <form action="/login" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email"
                    class="w-full p-3 border rounded mb-3" required>
                    @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                <input type="password" name="password" placeholder="Password"
                    class="w-full p-3 border rounded mb-3" required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                <button class="w-full bg-blue-600 text-white p-3 rounded">Login</button>
            </form>
    
            <p class="mt-4 text-center">
                Don't have an account? <a href="/register" class="text-blue-600">Register</a>
            </p>
        </div>
    </div>
@livewireScripts
</body>
</html>

