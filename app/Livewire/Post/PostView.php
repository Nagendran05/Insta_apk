<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('View-Post')]
class PostView extends Component
{
    public $post;
    public $comments = [];
    public $commentText = '';
    public $isLiked = false;
    public $likesCount = 0;

    public function mount($id)
    {
        // Load the post
        $this->post = Post::with('user.profile')->findOrFail($id);

        // Load comments
        $this->comments = Comment::where('post_id', $id)
            ->with('user.profile')
            ->latest()
            ->get();

        // Like status
        $this->isLiked = $this->post->likes()
            ->where('user_id', Auth::id())
            ->exists();

        // Like count
        $this->likesCount = $this->post->likes()->count();
    }

    public function toggleLike()
    {
        if ($this->isLiked) {
            $this->post->likes()->where('user_id', Auth::id())->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } else {
            $this->post->likes()->create(['user_id' => Auth::id()]);
            $this->isLiked = true;
            $this->likesCount++;
        }
    }

    public function addComment()
    {
        $this->validate([
            'commentText' => 'required|string|max:255'
        ]);

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'comment' => $this->commentText,
        ]);

        // Clear comment input
        $this->commentText = '';

        // Reload comments
        $this->comments = Comment::where('post_id', $this->post->id)
            ->with('user.profile')
            ->latest()
            ->get();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.post.post-view');
    }
}
