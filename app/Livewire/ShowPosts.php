<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPosts extends Component
{
    public $mensaje1, $mensaje2, $mensaje3;
    public $nombre;
    public $search;
    public $sort = 'id', $dir = 'asc';

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->dir)         
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

    public function sortTable($col)
    {
        if ($this->sort == $col) { // si se selecciona la misma columna
            if ($this->dir == 'asc') { // si la dirección es asc
                $this->dir = 'desc';
            } else{ // si la dirección es desc
                $this->dir = 'asc';
            }
        } else{ // si se selecciona otra columna
            $this->dir = 'asc'; // valor por defecto de la dirección
        }

        $this->sort = $col; // ordenar por ésta columna
    }
}
