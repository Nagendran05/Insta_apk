<?php

namespace App\Livewire\Profile;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class FollowButton extends Component
{
    public $userId;
    public $isFollowing = false;

    public function mount($userId)
    {
        $this->userId = $userId;

        $this->isFollowing = Follow::where('follower_id', Auth::id())
                                   ->where('following_id', $userId)
                                   ->exists();
    }

    public function toggleFollow()
    {
        if ($this->isFollowing) {
            Follow::where('follower_id', Auth::id())
                  ->where('following_id', $this->userId)
                  ->delete();

            $this->isFollowing = false;

        } else {
            Follow::create([
                'follower_id' => Auth::id(),
                'following_id' => $this->userId,
            ]);

            $this->isFollowing = true;
        }
    }

    public function render()
    {
        return view('livewire.profile.follow-button');
    }
}
