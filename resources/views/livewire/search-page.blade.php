<div class="min-h-screen bg-gray-100 p-6">
    <div class=" pt-15 rounded-xl mx-auto">
        <div class="p-4">
            {{-- Search Box --}}
            <input type="text" wire:model.live="query" placeholder="Search users..."class="w-full p-3 rounded-xl border">
            @if ($query === '')
                @if($oldSearches && count($oldSearches) > 0)
                <div class="flex justify-between items-center mt-4 mb-2">
                    <h3 class="text-sm text-gray-500">Recent Searches</h3>
            
                    <button wire:click="clearAll" class="text-blue-500 text-sm font-semibold">
                        Clear All
                    </button>
                </div>
                @endif

    
    
                @foreach($oldSearches as $history)
                    @php
                        $user = \App\Models\User::find($history->profile_id);
                    @endphp
                    <div class="flex justify-between items-center py-2">
                        <a href="{{ $user->id == auth()->id() ? '/profile' : '/profile/'.$user->id }}"class="flex items-center gap-3 mb-2">

                            {{-- Avatar --}}
                            <img src="{{ $user->profile? asset('storage/'.$user->profile->avatar) : 'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}"
                                class="w-10 h-10 rounded-full">

                            {{-- Username --}}
                            <p class="font-semibold">{{ $user->name }}</p>
                        </a>
                        <button wire:click="removeHistory({{ $history->id }})">
                            <ion-icon name="close-outline" class="text-md"></ion-icon>
                        </button>
                    </div>
                @endforeach
            @endif

            {{-- Results --}}
            @if($query !== '')
                <div class="mt-4 space-y-3 pb-10">
                    @forelse($results as $user)
                        <a  wire:click="saveHistory({{ $user->id }})"
                        class="flex items-center gap-3 p-3 bg-white rounded-xl shadow">

                            @if ($user->profile && $user->profile->avatar)
                                <img src="{{ asset('storage/'.$user->profile->avatar) }}" class="w-12 h-12 rounded-full">
                            @else
                                <img src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png"
                                    class="w-12 h-12 rounded-full">
                            @endif

                            <p class="font-semibold">{{ $user->name }}</p>

                        </a>
                    @empty
                        <p class="text-gray-500 text-center mt-6">No users found</p>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
</div>