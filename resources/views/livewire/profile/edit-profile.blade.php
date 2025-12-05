<div class="min-h-screen bg-gray-100 p-6 pt-20">
    <div class="max-w-md mx-auto  p-6 ">
        <h2 class="text-xl font-bold mb-4 text-center">Edit Profile</h2>
        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <p class="text-green-600 text-center mb-3">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="text-red-600 text-center mb-3">{{ session('error') }}</p>
        @endif

        <div class="text-center mb-4">
            <img src="{{ $profile?->avatar 
                ? asset('storage/' . $profile->avatar)
                : 'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}" class="w-24 h-24 rounded-full mx-auto mb-2">

            {{-- NEW AVATAR UPLOAD --}}
            <input type="file" wire:model="newAvatar" class="mt-2 px-5">

            {{-- PREVIEW IMAGE --}}
            @if ($newAvatar)
                <p class="text-sm text-gray-500 mt-2">Preview:</p>
                <img src="{{ $newAvatar->temporaryUrl() }}"
                    class="w-24 h-24 rounded-full mx-auto">
            @endif
        </div>
        {{-- USERNAME --}}
        <label class="block text-sm font-semibold mb-1">Username</label>
        <input type="text" wire:model="name" class="w-full border p-2 rounded mb-3">
        @error('name') 
            <p class="text-red-500 text-xs">
                {{ $message }}
            </p> 
        @enderror

        {{-- EMAIL --}}
        <label class="block text-sm font-semibold mb-1">Email</label>
        <input type="email" wire:model="email"
            class="w-full border p-2 rounded mb-3">
        @error('email') 
            <p class="text-red-500 text-xs">
                {{ $message }}
            </p> 
        @enderror

        {{-- BIO --}}
        <label class="block text-sm font-semibold mb-1">Bio</label>
        <textarea wire:model="bio"
            class="w-full border p-2 rounded mb-3"
            rows="3"></textarea>
        <button wire:click="updateProfile"
            class="w-full bg-blue-600 text-white py-2 rounded-lg mt-2">
            Save Profile
        </button>
        <hr class="my-6">

        {{-- Toggle Button --}}
        <button wire:click="togglePasswordSection"
            class="w-full bg-gray-200 text-black py-2 rounded-lg mb-3">
            {{ $showPasswordSection ? 'Hide Password Change' : 'Change Password' }}
        </button>


        {{-- PASSWORD SECTION (Shows ONLY when clicked) --}}
        @if($showPasswordSection)
            <h3 class="text-lg font-semibold mb-2">Change Password</h3>

            {{-- OLD PASSWORD --}}
            <label class="block text-sm font-semibold mb-1">Old Password</label>
            <input type="password" wire:model="old_password"class="w-full border p-2 rounded mb-3">

            {{-- NEW PASSWORD --}}
            <label class="block text-sm font-semibold mb-1">New Password</label>
            <input type="password" wire:model="new_password" class="w-full border p-2 rounded mb-3">

            {{-- CONFIRM PASSWORD --}}
            <label class="block text-sm font-semibold mb-1">Confirm Password</label>
            <input type="password" wire:model="confirm_password"class="w-full border p-2 rounded mb-3">

            <button wire:click="updatePassword"
                class="w-full bg-green-600 text-white py-2 rounded-lg mt-2">
                    Update Password
            </button>
        @endif
    </div>
</div>