<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Followers')]
class FollowersList extends Component
{
    public $user;
    public $followers;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);

        // fetch followers
        $this->followers = $this->user->followers()->with('followers.profile')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.profile.followers-list');
    }
}
