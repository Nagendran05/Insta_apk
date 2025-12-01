<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use App\Models\User;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('view-profile')]
class ViewProfile extends Component
{
    public $profile ;
    public $posts;
    public $followersCount;
    public $followingCount;

    public function mount()
{
    $this->profile = Profile::where('user_id', Auth::id())->first();

    $this->posts = Post::where('user_id',Auth::id())->latest()->get();

   $user = Auth::user();

    $this->followersCount = $user->followers()->count();
    $this->followingCount = $user->following()->count();
}

    public function logout()
    {
        Auth::logout();                   // CLEAR SESSION
        session()->invalidate();          // INVALIDATE OLD SESSION
        session()->regenerateToken();     // NEW SESSION TOKEN

        return redirect('/login');        // SEND TO LOGIN PAGE
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->profile = Profile::where('user_id', Auth::id())->first();
        return view('livewire.profile.view-profile',['user'=>Auth::user()]);
    }
}
