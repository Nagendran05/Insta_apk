<div class="p-4 pt-20">
    <h2 class="text-xl font-bold mb-4">Followers</h2>

    @forelse($followers as $f)
        <a href="/profile/{{ $f->id }}" class="flex items-center gap-3 mb-3">

            {{-- avatar --}}
            <img src="{{ $f->profile->avatar
                        ? asset('storage/'.$f->profile->avatar)
                        : 'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}"
                 class="w-10 h-10 rounded-full">

            {{-- name --}}
            <p class="font-semibold">{{ $f->name }}</p>

        </a>
    @empty
        <p class="text-gray-500">No followers yet.</p>
    @endforelse
</div>
