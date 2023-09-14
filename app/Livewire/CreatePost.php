<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $title, $content;

    public function render()
    {
        return view('livewire.create-post');
    }

    public function store(): void
    {
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);
    }
}
