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
        {{ $isLiked ? '❤️' : '🤍' }}
    </button>

    <p class="font-semibold mb-4">{{ $likesCount }} likes</p>

    {{-- CAPTION --}}
    <p class="mb-4">
        <span class="font-bold">{{ $post->user->name }}</span>
        {{ $post->caption }}
    </p>

    {{-- COMMENTS --}}
    <div class="space-y-3 mb-5">
        @foreach($comments->take(2) as $c)
            <div class="bg-white p-3 rounded-xl shadow-sm flex items-start gap-3">
                <img src="{{ $c->user->profile && $c->user->profile->avatar
                    ? asset('storage/'.$c->user->profile->avatar)
                    : 'https://i.pravatar.cc/80' }}"
                    class="w-8 h-8 rounded-full">
                <p class="text-sm">
                    <strong>{{ $c->user->name }}</strong>
                    {{ $c->comment }}
                </p>
            </div>
        @endforeach
    </div>

    {{-- ADD COMMENT --}}
    <div class="flex gap-2">
        <input wire:model="commentText"
               class="flex-1 border rounded-xl p-2"
               placeholder="Add a comment...">

        <button wire:click="addComment"
                class="bg-blue-600 text-white px-4 rounded-xl">
            Send
        </button>
    </div>
</div>