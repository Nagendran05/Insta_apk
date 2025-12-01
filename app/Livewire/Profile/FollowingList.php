<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Followers')]
class FollowingList extends Component
{
    public $user;
    public $following;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);

        // users this user is following
        $this->following = $this->user->following()->with('following.profile')->get();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.profile.following-list');
    }
}
