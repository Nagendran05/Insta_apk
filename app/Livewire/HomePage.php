<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Home')]
class HomePage extends Component
{
    public $post =[];
    public  $comment = [];
    public $showComments = [];

public function mount()
{
    $this->post = Post::with(['user.profile', 'likes', 'comments.user'])
        ->latest()
        ->get();
}

public function toggleComments($postId)
{
    $this->showComments[$postId] = !($this->showComments[$postId] ?? false);
}


public function addComment($postId)
{
    $this->validate([
        "comment.$postId" => "required"
    ]);
    Comment::create([
        'post_id' => $postId,
        'user_id' => Auth::id(),
        'comment' => $this->comment[$postId],
    ]);
    // Clear input
    $this->comment[$postId] = "";
}

public function toggleLike($postId)
{
    $like = Like::where('user_id', Auth::id())
        ->where('post_id', $postId)
        ->first();

    if ($like) {
        $like->delete();
    } else {
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $postId
        ]);
    }
    // $this->loadPosts();

   
}
#[Layout('layouts.app')]
public function render()
{
    return view('livewire.home-page');
}

}
