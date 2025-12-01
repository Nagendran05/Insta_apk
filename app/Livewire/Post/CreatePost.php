<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;


#[Title('Create-Post')]
class CreatePost extends Component 
{

    use WithFileUploads;

    public $image , $caption;
    public $visibility ='evevryone';
    
    public function save(){
        $this->validate([
            'image'=>'required|image|max:20480',
            'caption'=>'nullable|string|max:255',
            'visibility'=>'required|string'
        ]);
        $path = $this->image->store('posts','public');

          Post::create([
            'user_id' => Auth::id(),
            'image'   => $path,
            'caption' => $this->caption,
            'visibility'=>$this->visibility
        ]);
        $this->reset(['image', 'caption']);

        return redirect()->route('home');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.post.create-post');
    }
}
