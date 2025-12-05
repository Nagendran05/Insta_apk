
<div class="min-h-screen bg-gray-100 p-6">
    <div class="relative">
       {{-- GLOBAL MENU ICON - FIXED, ALWAYS VISIBLE --}}
        <button wire:click="$set('menuOpen', true)" 
            class="fixed right-0 top-18 text-2xl">
            <ion-icon name="ellipsis-vertical-outline"></ion-icon>
        </button>

        {{-- DROPDOWN MENU --}}
        @if($menuOpen)
            <div class="fixed right-4 top-30 bg-white shadow-xl rounded-xl w-44 py-3">
                <div class="flex justify-between items-center px-3 mb-2 border-b pb-2">
                    <p class="font-semibold text-gray-700 text-sm">Menu</p>
                    <button wire:click="$set('menuOpen', false)">
                        <ion-icon name="close-outline" class="text-2xl"></ion-icon>
                    </button>
                </div>

                <a href="/edit-profile" class="block px-4 py-2 hover:bg-gray-100 text-sm">
                    Edit Profile
                </a>
                <button wire:click="logout" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600 text-sm">
                    Logout
                </button>
            </div>

        @else
            <button wire:click="$set('menuOpen', true)" 
                class="fixed right-0 top-18 text-2xl">
                <ion-icon name="ellipsis-vertical-outline"></ion-icon>
            </button>
        @endif
        
        <div class=" pt-15 rounded-xl ">
            <div class="flex">

                <img src="{{ $profile?->avatar 
                    ? asset('storage/' . $profile->avatar)
                    :'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}"
                        class="w-24 h-24 rounded-full  mb-4">
                        
                {{-- Name --}}
                <div>
                    <h2 class="text-xl font-bold text-center ml-5 mt-1">
                        {{ auth()->user()->name }}
                    </h2>
                    {{-- Followers / Following --}}
                    <div class="flex justify-center gap-8 text-center mt-3 ml-3">
                        <div>
                            <a href="/profile/{{ $profile?->user_id }}/followers" class="text-center">
                                <p class="text-xl font-semibold">{{ $followersCount }}</p>
                                <p class="text-sm text-gray-500">Followers</p>
                            </a>
                        </div>
                    <div>
                    <a href="/profile/{{ $profile?->user_id }}/following" class="text-center">
                        <p class="text-xl font-semibold">{{ $followingCount }}</p>
                        <p class="text-sm text-gray-500">Following</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

        {{-- ✅ FOLLOW BUTTON GOES HERE --}}
        {{-- <div class="flex justify-center mb-4">
            <livewire:profile.follow-button :userId="$user->id" />
        </div> --}}
        
        {{-- Bio --}}
        <p class="text-gray-600 mb-0 ml-1">
            {{ $profile->bio ?? 'No bio added' }}
        </p>


    {{-- <div class="flex justify-evenly">
        <a href="/edit-profile" class="block mt-4 text-center bg-blue-600 text-white p-3 rounded-xl">
            Edit Profile
        </a>
        <button wire:click='logout'class="block mt-4 text-center bg-blue-600 text-white p-3 rounded-xl">
            Logout
        </button>
    </div> --}}

    {{-- Posts --}}
        <h3 class="mt-18 mb-2 font-semibold text-lg">Posts</h3>
        <div class="grid grid-cols-3 gap-3">
            @forelse ($posts as $p)
                <a href="/post/{{ $p->id }}">
                    <img src="{{ asset('storage/'.$p->image) }}" class="w-full h-32 object-cover rounded">
                </a>
            @empty
                <p class="text-gray-400 col-span-3 text-center">No Posts</p>
            @endforelse
        </div>
    </div>
</div>