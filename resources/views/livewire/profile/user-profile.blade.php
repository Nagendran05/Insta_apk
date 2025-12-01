<div class="min-h-screen bg-gray-100 p-6 pt-20">

    {{-- Avatar --}}
    <div class="flex flex-col items-center">
        @if ($profile && $profile->avatar)
            <img src="{{ asset('storage/'.$profile->avatar) }}"
                 class="w-24 h-24 rounded-full mb-3">
        @else
            <img src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png"
                 class="w-24 h-24 rounded-full mb-3">
        @endif

        {{-- Name --}}
        <h2 class="text-xl font-bold">{{ $user->name }}</h2>
    </div>

    {{-- Follow Button --}}
    <div class="flex justify-center mt-4">
        <livewire:profile.follow-button :userId="$user->id" />
    </div>

    {{-- Followers / Following --}}
    <div class="flex justify-center gap-10 text-center mt-6">
        <div>
            <p class="text-xl font-bold">{{ $followersCount }}</p>
            <p class="text-sm text-gray-500">Followers</p>
        </div>
        <div>
            <p class="text-xl font-bold">{{ $followingCount }}</p>
            <p class="text-sm text-gray-500">Following</p>
        </div>
    </div>

    {{-- Bio --}}
    <div class="mt-4 text-center text-gray-700">
        {{ $profile->bio ?? 'No bio added' }}
    </div>

    {{-- Posts Grid --}}
    <h3 class="mt-8 mb-2 font-semibold text-lg">Posts</h3>

    <div class="grid grid-cols-3 gap-1">
        @forelse ($posts as $post)
            <a href="/post/{{ $post->id }}">
                <img src="{{ asset('storage/'.$post->image) }}"
                     class="w-full h-32 object-cover">
            </a>
        @empty
            <p class="text-gray-400 col-span-3 text-center">No Posts</p>
        @endforelse
    </div>

</div>
