<div class="min-h-screen bg-gray-100 p-6">
    <div class=" pt-15 rounded-xl mx-auto">
        <div class="p-4">

            {{-- Search Box --}}
            <input type="text" wire:model.live="query" placeholder="Search users..."class="w-full p-3 rounded-xl border">

            {{-- Results --}}
            <div class="mt-4 space-y-3">
                @forelse($results as $user)
                    <a href="/profile/{{ $user->id }}" class="flex items-center gap-3 p-3 bg-white rounded-xl shadow">
                    
                        {{-- Avatar --}}
                        @if ($user->profile && $user->profile->avatar)
                            <img src="{{ asset('storage/'.$user->profile->avatar) }}" class="w-12 h-12 rounded-full">
                        @else
                            <img src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png" class="w-12 h-12 rounded-full">
                        @endif
                        <p class="font-semibold">{{ $user->name }}</p>
                    </a>
                    @empty
                    @if($query !== '')
                        <p class="text-gray-500 text-center mt-6">No users found</p>
                    @endif
                @endforelse
            </div>
        </div>
    </div>
</div>