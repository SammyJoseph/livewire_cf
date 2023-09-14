<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPosts extends Component
{
    public $mensaje1, $mensaje2, $mensaje3;
    public $nombre;
    public $search;

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')                
                        ->get();

        return view('livewire.show-posts', compact('posts'));
        // return view('livewire.show-posts')->layout('layouts.app'); // se puede especificar el layout cuando se usa livewire como controlador
            
    }

    public function mount($mensaje1 = 'null')
    {
        $this->mensaje3 = $mensaje1;
    }

    // mount() recibe el parámetro $name desde la ruta y lo guarda en una propiedad de livewire
    /* public function mount($name = null)
    {
        $this->nombre = $name;
    } */
}
