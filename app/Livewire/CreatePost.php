<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $title, $content, $image;
    public $isOpenModal = false;
    public $isOpenToast = false;

    public function render()
    {
        return view('livewire.create-post');
    }

    public function store(): void
    {
        $this->validate([
            'title'     => 'required|min:3|max:100',
            'content'   => 'required|min:3|max:256',
            'image'     => 'required|image|max:2048',
        ]);

        $img = $this->image->store('public/posts'); // guarda la imagen en la carpeta
        $img = str_replace('public/', '', $img); // después de guardar, quitar el prefijo public/

        Post::create([
            'title'     => $this->title,
            'content'   => $this->content,
            'image'     => $img,
            'user_id'   => auth()->id(),
        ]);

        $this->clearForm();
        $this->dispatch('postCreated'); // evento escuchado desde ShowPosts
        $this->isOpenToast = true;
    }

    public function clearForm(): void
    {
        $this->reset(['title', 'content', 'image', 'isOpenModal']);
        $this->dispatch('resetFileInput'); // resetea el nombre de archivo seleccionada anteriormente
    }
}
