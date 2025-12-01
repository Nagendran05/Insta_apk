<div class="min-h-screen bg-gray-100 p-6">

    <div class=" pt-15 rounded-xl mx-auto">
        <img src="{{ $profile?->avatar 
            ? asset('storage/' . $profile->avatar)
            :'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}"
            class="w-24 h-24 rounded-full mx-auto mb-4">

        {{-- Name --}}
        <h2 class="text-xl font-bold text-center">
            {{ auth()->user()->name }}
        </h2>
    </div>

    {{-- ✅ FOLLOW BUTTON GOES HERE --}}
    <div class="flex justify-center mb-4">
        <livewire:profile.follow-button :userId="$user->id" />
    </div>
        
    {{-- Bio --}}
    <p class="text-center text-gray-600 mb-4">
        {{ $profile->bio ?? 'No bio added' }}
    </p>

    {{-- Followers / Following --}}
    <div class="flex justify-center gap-8 text-center mb-6">
        <div>
            <a href="/profile/{{ $profile->user_id }}/followers" class="text-center">
                <p class="text-xl font-semibold">{{ $followersCount }}</p>
                <p class="text-sm text-gray-500">Followers</p>
            </a>
        </div>
        <div>
            <a href="/profile/{{ $profile->user_id }}/following" class="text-center">
                <p class="text-xl font-semibold">{{ $followingCount }}</p>
                <p class="text-sm text-gray-500">Following</p>
            </a>
        </div>
    </div>

    <div class="flex justify-evenly">
        <a href="/edit-profile" class="block mt-4 text-center bg-blue-600 text-white p-3 rounded-xl">
            Edit Profile
        </a>
        <button wire:click='logout'class="block mt-4 text-center bg-blue-600 text-white p-3 rounded-xl">
            Logout
        </button>
    </div>

    {{-- Edit Profile --}}
    <h3 class="mt-8 mb-2 font-semibold text-lg">Posts</h3>
    <div class="grid grid-cols-3 gap-1">
        @forelse ($posts as $p)
            <a href="/post/{{ $p->id }}">
                <img src="{{ asset('storage/'.$p->image) }}"
                    class="w-full h-32 object-cover rounded">
            </a>
        @empty
            <p class="text-gray-400 col-span-3 text-center">No Posts</p>
        @endforelse
    </div>
</div>
