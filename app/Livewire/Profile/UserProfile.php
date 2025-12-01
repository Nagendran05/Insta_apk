<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('User-profile')]
class UserProfile extends Component
{
    public $user;
    public $profile;
    public $posts;
    public $followersCount;
    public $followingCount;

    public function mount($id)
    {
        // Load the user being viewed
        $this->user = User::findOrFail($id);

        // Load profile
        $this->profile = Profile::where('user_id', $id)->first();

        // Load posts
        $this->posts = Post::where('user_id', $id)->latest()->get();

        // Followers / Following count
        $this->followersCount = $this->user->followers()->count();
        $this->followingCount = $this->user->following()->count();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.profile.user-profile');
           
    }
}
