<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    <link rel="shortcut icon" href="https://dreamfoundry.org/wp-content/uploads/2018/12/instagram-logo-png-transparent-background.png" type="image/x-icon">
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class=" p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-6">Instagram</h2>

            <form action="/register" method="POST">
                @csrf
    
                <input type="text" name="name" placeholder="Name"
                    class="w-full p-3 border rounded mb-3" required>
    
                <input type="email" name="email" placeholder="Email"
                    class="w-full p-3 border rounded mb-3" required>
    
                <input type="password" name="password" placeholder="Password"
                    class="w-full p-3 border rounded mb-3" required>
    
                <button class="w-full bg-blue-600 text-white p-3 rounded">Register</button>

            </form>
    
            <p class="mt-4 text-center">
                Already have an account? <a href="/login" class="text-blue-600">Login</a>
            </p>
        </div>
    </div>
</body>
@livewireScripts()
</html>
