<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ShowPosts extends Component
{
    use WithFileUploads;

    protected $listeners = [ // eventos enviados desde CreatePost & EditPost
        'postCreated'       => 'render',
        'postUpdated'       => 'render',
        'show-edit-toast'   => 'showEditToast', // llama al método showEditToast
        'show-delete-toast' => 'showDeleteToast',
    ];

    public $openEditModal = false, $openDeleteModal = false, $title, $content, $image;
    public $epost, $dpost; // $epost = parámetro Post enviado al editar un post
    public $isOpenEditToast = false, $isOpenDeleteToast = false;
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

    /* public function mount($mensaje1 = 'null')
    {
        $this->mensaje3 = $mensaje1;
    } */

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

    public function editModal(Post $post)
    {
        $this->epost = $post; // asignar el post actual al hacer clic sobre el botón editar
        $this->title = $post->title;
        $this->content = $post->content;
        $this->image = $post->image;
        $this->openEditModal = true;
    }

    public function deleteModal(Post $post)
    {
        $this->dpost = $post; // asignar el post actual al hacer clic sobre el botón eliminar
        $this->openDeleteModal = true;
    }

    public function update()
    {
        $this->validate([
            'title'     => 'required|min:3|max:100',
            'content'   => 'required|min:3|max:256',
        ]);

        if (Str::startsWith($this->image, 'posts/')) { // si no se selecciona una imagen en el input, se mantiene la anterior (de la bd)
            $img = $this->epost->image;
        } else {
            $this->validate([
                'image'     => 'image|max:2048',
            ]);
            Storage::delete([$this->epost->image]); // elimina la imagen de la carpeta
            $img = $this->image->store('posts'); // guarda la imagen en la carpeta
        }

        $this->epost->update([
            'title'     => $this->title,
            'content'   => $this->content,
            'image'       => $img,
        ]);

        $this->isOpenEditToast = true; // mostrar toast de confirmación
        $this->reset(['openEditModal', 'epost']);
    }

    function destroy()
    {
        $post = Post::find($this->dpost->id); // encuentra al post
        Storage::delete([$post->image]); // elimina la imagen de la carpeta
        $post->delete();
        
        $this->isOpenDeleteToast = true; // mostrar toast de confirmación
        $this->reset(['openDeleteModal', 'dpost']);
    }
}
