<div class="p-4 pt-20">
    <h2 class="text-xl font-bold mb-4">Following</h2>

    @forelse($following as $f)
        <a href="/profile/{{ $f->id }}" class="flex items-center gap-3 mb-3">

            {{-- Avatar Safe Load --}}
            <img src="{{ 
                $f->profile && $f->profile->avatar
                    ? asset('storage/'.$f->profile->avatar)
                    : 'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png'
            }}"
            class="w-10 h-10 rounded-full">

            {{-- Username --}}
            <p class="font-semibold">
                {{ $f->name }}
            </p>

        </a>
    @empty
        <p class="text-gray-500">Not following anyone.</p>
    @endforelse
</div>
