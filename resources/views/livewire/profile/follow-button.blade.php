<div>
    @if (auth()->id() != $userId)
        <button wire:click="toggleFollow"class="px-4 py-2 rounded-lg text-white 
            {{ $isFollowing ? 'bg-gray-500' : 'bg-blue-600' }}">
                {{ $isFollowing ? 'Following' : 'Follow' }}
        </button>
    @endif
</div>
