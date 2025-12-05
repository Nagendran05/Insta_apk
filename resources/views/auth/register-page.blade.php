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
    {{-- <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class=" p-8 w-full max-w-md">
            @if(session('success'))
                <p class="bg-green-100 text-green-700 p-2 rounded mb-3">
                    {{ session('success') }}
                </p>
            @endif
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
    </div> --}}

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class=" p-6 rounded-xl  w-full max-w-md">

            {{-- Success Message --}}
            @if(session('success'))
                <p class="bg-green-100 text-green-700 p-2 rounded mb-3">
                    {{ session('success') }}
                </p>
            @endif

            <h2 class="text-xl font-bold mb-4">Register</h2>

            <form action="/register" method="POST">
                @csrf

                {{-- NAME --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full border p-2 rounded
                            @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full border p-2 rounded
                            @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full border p-2 rounded
                            @error('password') border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full border p-2 rounded">
            </div>

            {{-- Register Button  --}}
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg">
                Register
            </button>

        </form>
    </div>
</div>

</body>
@livewireScripts()
</html>
