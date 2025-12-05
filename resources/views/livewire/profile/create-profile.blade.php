<div class="min-h-screen flex py-20 bg-gray-100">
    <div class=" p-6 rounded-xl   w-full">
        <h2 class="text-xl font-bold mb-4">Create Profile</h2>

        <form wire:submit.prevent="save" class="space-y-4">
            
            {{-- Bio  --}}
            <div>
                <label class="block text-sm mb-1">Bio</label>
                <textarea wire:model="bio"
                            class="w-full border rounded p-2"
                            rows="3"></textarea>
                @error('bio') 
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Avatar  --}}
            <div>
                <label class="block text-sm mb-1">Avatar</label>
                <input type="file" wire:model="avatar">
                @error('avatar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                @if ($avatar)
                    <p class="text-xs mt-2">Preview:</p>
                    <img src="{{ $avatar->temporaryUrl() }}" class="w-16 h-16 rounded-full">
                @endif
            </div>
            {{-- Save btn  --}}
            <button class="w-full bg-blue-600 text-white py-2 rounded">
                Save Profile
            </button>
        </form>
    </div>
</div>