<div class="min-h-screen bg-gray-100 p-4 py-20">
    {{-- USER BLOCK AT TOP --}}
    <div class="flex items-center gap-3 mb-4">
        {{-- Avatar --}}
        <a href="/profile/{{ $post->user_id }}">
            <img src="{{ $post->user->profile && $post->user->profile->avatar
                ? asset('storage/'.$post->user->profile->avatar)
                : 'https://i.pravatar.cc/100' }}"
                class="w-10 h-10 rounded-full object-cover">
        </a>

        {{-- Username --}}
        <a href="/profile/{{ $post->user_id }}" 
           class="font-semibold text-sm">
            {{ $post->user->name }}
        </a>

    </div>

    {{-- POST IMAGE --}}
    <img src="{{ asset('storage/'.$post->image) }}"
         class="w-full rounded-xl mb-4">

    {{-- LIKE BUTTON --}}
    <button wire:click="toggleLike" class="text-3xl mb-2">
        {{-- {{ $isLiked ? '❤️' : '🤍' }} --}}
        <i class="{{ $isLiked ? 'fa-solid fa-heart text-red-600 text-xl' : 'fa-regular fa-heart text-xl' }}"></i>
    </button>

    {{-- <p class="font-semibold mb-4">{{ $likesCount }} likes</p> --}}
    <p class="text-sm  cursor-pointer"  wire:click='showLikedUsers({{ $post->id }})'>
        {{ $likesCount }} 
        {{ $likesCount == 1 ? 'Like' : 'Likes' }}
    </p> 
    @if($showLikes)
        <div class="fixed inset-0 backdrop-blur-sm
            flex items-center justify-center" wire:click="closeLikes">
            <div class="bg-white rounded-xl w-80 border max-h-96 overflow-y-auto p-4" wire:click.stop>
                 {{-- Likes --}}
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-lg font-bold">Liked by</h2>
                    <button wire:click="closeLikes">
                        <ion-icon name="close-outline" class="text-2xl"></ion-icon>
                    </button>
                </div>

                @forelse($likesList as $like)
                    <a href="{{ $post->user_id == auth()->id() ? '/profile' : '/profile/'.$post->user_id }}" 
                        class="flex items-center gap-3 py-2">
                        {{-- Avatar --}}
                        <img src="{{ $like->user->profile?->avatar 
                            ? asset('storage/'.$like->user->profile->avatar)
                            : 'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}" class="w-10 h-10 rounded-full">
                        {{-- Name --}}
                            <p class="font-semibold">{{ $like->user->name }}</p>
                    </a>
                @empty
                    <p class="text-center text-gray-500 py-4">No likes yet</p>
                @endforelse
            </div>
        </div>
    @endif
    {{-- CAPTION --}}
    <p class="mb-4">
        <span class="font-bold">{{ $post->user->name }}</span>
        {{ $post->caption }}
    </p>

    {{-- ADD COMMENT --}}
    <div class="flex gap-2 mb-4">
        <input wire:model="commentText"
               class="text-sm focus:outline-none focus:ring-0"
               placeholder="Add a comment...">

        <button wire:click="addComment"
                class="text-blue-600  px-33 rounded text-sm">
            Post
        </button>
    </div>

    {{-- COMMENTS --}}
    <div class="ml-3">
        @foreach($post->comments->take(2) as $c)
            <p class="text-sm">
                <span class="font-semibold">{{ $c->user->name }}:</span>
                    {{ $c->comment }}
            </p>
        @endforeach
    
        {{-- Comment Icon Button --}}
        <button wire:click="toggleComments({{ $post->id }})"
            class="flex items-center text-gray-600 hover:text-black mt-1">
    
            {{-- <i class="fa-regular fa-comment text-lg"></i> --}}
            <span class="ml-1 mb-2 text-sm">
                {{ ($showComments[$post->id] ?? false) ? 'Hide comments' : 'View all comments' }}
            </span>
        </button>
    
        {{-- When clicked → Show all comments --}}
        @if($showComments[$post->id] ?? false)
            <div class="mt-2 mb-2 border-l border-gray-300">
                @foreach($post->comments as $c)
                    <p class="text-sm mb-1">
                        <span class="font-semibold">{{ $c->user->name }}:</span>
                            {{ $c->comment }}
                    </p>
                @endforeach
            </div>
        @endif
    </div>
</div>
