<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $title, $content;
    public $isOpen = false;
    public $isOpenToast = false;

    public function render()
    {
        return view('livewire.create-post');
    }

    public function store(): void
    {
        $this->validate([
            'title' => 'required|min:3|max:100',
            'content' => 'required|min:3|max:256',
        ]);

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);

        $this->clearForm();
        $this->dispatch('postCreated'); // evento escuchado desde ShowPosts
        $this->isOpenToast = true;
    }

    public function clearForm(): void
    {
        $this->reset(['title', 'content', 'isOpen']);
    }
}
