<div>
    <div class="min-h-screen flex pt-20 justify-center bg-gray-100 pb-20">
        <div class=" p-6 w-full">
            <h2 class="text-xl font-bold mb-4">Create Post</h2>
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-sm mb-1 font-semibold">Image</label>

                    <div class="flex items-center">
                        <label for="imageInput" class="cursor-pointer hover:bg-gray-200 hover:text-black px-4 py-2 rounded-lg text-sm bg-gray-400 text-white transition">
                            Choose Image
                        </label>

                        <span class="ml-3 text-sm text-gray-600">
                            {{ $image ? $image->getClientOriginalName() : '' }}
                        </span>
                    </div>

                    <input type="file" id="imageInput" wire:model="image" class="hidden">

                    @error('image') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror

                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="mt-3 w-full rounded-xl shadow">
                    @endif
                </div>

                <div>
                    <label class="block text-sm mb-1">Caption</label>
                    <textarea wire:model="caption" class="w-full border rounded p-2"rows="3"></textarea>
                    @error('caption')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button class="w-full bg-blue-600 text-white py-2 rounded">
                    Post
                </button>
            </form>
        </div>
    </div>
</div>

