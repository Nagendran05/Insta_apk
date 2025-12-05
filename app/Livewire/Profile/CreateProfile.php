<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;


#[Title('Create-Profile')]
class CreateProfile extends Component
{

    use WithFileUploads;

    public $bio , $avatar;

    public function mount(){
        $existing = Profile::where('user_id',Auth::id())->first();

        if ($existing) {
            return redirect()
            ->route('profile.edit');
        }
    }

    public function save(){
        $this->validate([
            'bio'=>'nullable|string|max:255',
            'avatar'=>'nullable|image|max:20480'
        ]);

        $path = null;

        if ($this->avatar) {
            $path = $this->avatar->store('avatars','public');
        }

        Profile::create([
            'user_id'=>Auth::id(),
            'bio'=>$this->bio,
            'avatar'=>$path
        ]);

        return redirect()->route('home');
    }
    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.profile.create-profile');
    }
}
