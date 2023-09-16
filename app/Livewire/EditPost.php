<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
    use WithFileUploads;

    public $post; // esta variable se envía desde @livewire('edit-post', ['post' => $post]) en show-posts.blade

    public $title, $content, $image;
    public $isOpenModal = false;

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function mount(Post $post) // inicializar $this->post
    {
        $this->post     = $post;
        $this->title    = $post->title;
        $this->content  = $post->content;
    }

    public function update()
    {
        $this->validate([
            'title'     => 'required|min:3|max:100',
            'content'   => 'required|min:3|max:256',
            'image'     => 'required|image|max:2048',
        ]);

        if ($this->image){
            Storage::delete([$this->post->image]); // elimina la imagen de la carpeta
        }
        $img = $this->image->store('posts'); // guarda la imagen en la carpeta

        $this->post->update([
            'title'     => $this->title,
            'content'   => $this->content,
            'image'     => $img,
        ]);

        $this->dispatch('postUpdated');
        $this->dispatch('show-edit-toast'); // este evento lo recibe ShowPosts
        $this->reset(['isOpenModal', 'image']);
    }
}
