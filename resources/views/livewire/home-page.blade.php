<div class="bg-gray-100 min-h-screen pt-20 pb-24">
    <div class="mt-4 space-y-6 px-4">
        @forelse($post as $posts)
            <div class="bg-white rounded-xl shadow overflow-hidden">
                {{-- User row --}}
                <a href="{{ $posts->user_id == auth()->id() ? '/profile' : '/profile/'.$posts->user_id }}" class="font-bold">
                    <div class="flex items-center p-3">
                        <img src="{{ $posts->user->profile && $posts->user->profile->avatar ? asset('storage/'.$posts->user->profile->avatar)
                            : 'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}"
                             class="w-10 h-10 rounded-full">
                        <div class="ml-3">
                            <p>{{ $posts->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $posts->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>

                {{-- Post image --}}
                <a href="{{ $posts->user_id == auth()->id() ? '/profile' : '/profile/'.$posts->user_id }}">
                {{-- <a href="/profile/{{ $posts->user_id }}"> --}}
                    <img src="{{ asset('storage/'.$posts->image) }}"class="w-full  mb-4">
                </a>

                {{-- Actions --}}
                <div class="px-4 py-3 ">
                    <button wire:click="toggleLike({{ $posts->id }})">
                        @php
                            $liked = $posts->likes->contains('user_id', auth()->id());
                        @endphp
                        <i class="{{ $liked ? 'fa-solid fa-heart text-red-600 text-xl' : 'fa-regular fa-heart text-xl' }}"></i>
                        </span>
                    </button>
                    <p class="text-sm  cursor-pointer"  wire:click='showLikedUsers({{ $posts->id }})'>
                        {{ $posts->likes->count() }} 
                        {{ $posts->likes->count() == 1 ? 'Like' : 'Likes' }}
                    </p>                    
                </div>

                {{-- Likes Popup --}}
                @if($showLikes)
                    <div class="fixed inset-0 backdrop-blur-sm
                                flex items-center justify-center" wire:click="closeLikes">
                        <div class="bg-white rounded-xl w-80 border max-h-96 overflow-y-auto p-4"
                            wire:click.stop>
                            
                            <div class="flex justify-between items-center mb-3">
                                <h2 class="text-lg font-bold">Liked by</h2>
                                <button wire:click="closeLikes">
                                    <ion-icon name="close-outline" class="text-2xl"></ion-icon>
                                </button>
                            </div>

                            @forelse($likesList as $like)
                                <a href="{{ $posts->user_id == auth()->id() ? '/profile' : '/profile/'.$posts->user_id }}" 
                                class="flex items-center gap-3 py-2">

                                    {{-- Avatar --}}
                                    <img src="{{ $like->user->profile?->avatar 
                                        ? asset('storage/'.$like->user->profile->avatar)
                                        : 'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}"
                                        class="w-10 h-10 rounded-full">

                                    {{-- Name --}}
                                    <p class="font-semibold">{{ $like->user->name }}</p>
                                </a>
                            @empty
                                <p class="text-center text-gray-500 py-4">No likes yet</p>
                            @endforelse
                        </div>
                    </div>
                @endif

                {{-- Comments --}}
                <div class="px-4 pb-2">
                    
                    {{-- Add Comment --}}
                    <form wire:submit.prevent="addComment({{ $posts->id }})"
                        wire:key="comment-form-{{ $posts->id }}"
                        class="flex gap-1">
                        
                        <input wire:model="comment.{{ $posts->id }}"wire:key="comment-input-{{ $posts->id }}"
                        class="text-sm focus:outline-none focus:ring-0"
                        placeholder="Add a comment..." >
                        
                        <button class="text-blue-600  px-33 rounded text-sm">Post</button>
                    </form>
                    
                    @error("comment.$posts->id")
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    
                </div>

                {{-- Caption --}}
                <div class="pl-3 pb-3">
                    <p>
                        <span class="font-semibold">{{ $posts->user->name }} :</span>
                        {{ $posts->caption }}
                    </p>
                </div>

                {{-- Show Latest 2 Comments --}}
                <div class="ml-3">

                    @foreach($posts->comments->take(2) as $c)
                        <p class="text-sm">
                            <span class="font-semibold">{{ $c->user->name }}:</span>
                            {{ $c->comment }}
                        </p>
                    @endforeach
    
                    {{-- Comment Icon Button --}}
                    <button wire:click="toggleComments({{ $posts->id }})"
                         class="flex items-center text-gray-600 hover:text-black mt-1">
    
                        {{-- <i class="fa-regular fa-comment text-lg"></i> --}}
                        <span class="ml-1 mb-2 text-sm">
                            {{ ($showComments[$posts->id] ?? false) ? 'Hide comments' : 'View all comments' }}
                        </span>
                    </button>
    
                    {{-- When clicked → Show all comments --}}
                    @if($showComments[$posts->id] ?? false)
                        <div class="mt-2 mb-2 pl-2 border-l border-gray-300">
                            @foreach($posts->comments as $c)
                                <p class="text-sm mb-1">
                                    <span class="font-semibold">{{ $c->user->name }}:</span>
                                        {{ $c->comment }}
                                </p>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            @empty
            <p class="text-center text-gray-500 mt-10">No posts yet.</p>
        @endforelse
    </div>
</div>

