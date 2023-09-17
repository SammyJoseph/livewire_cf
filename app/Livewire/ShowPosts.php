<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ShowPosts extends Component
{
    use WithFileUploads, WithPagination;

    protected $listeners = [ // eventos enviados desde CreatePost & EditPost
        'postCreated'       => 'render',
        'postUpdated'       => 'render',
        'show-edit-toast'   => 'showEditToast', // llama al método showEditToast
        'show-delete-toast' => 'showDeleteToast',
    ];

    public $openEditModal = false, $openDeleteModal = false, $title, $content, $image;
    public $epost, $dpost; // $epost = parámetro Post enviado al editar un post
    public $isOpenEditToast = false, $isOpenDeleteToast = false;
    public $search = '';
    public $perPage = '10'; // el 10 como cadena para que funcione el except del queryString
    public $sort = 'id', $dir = 'asc';

    protected $queryString = [ // definir propiedades que viajan en la URL
        'perPage'   => ['except' => '10'], // las excepciones (valores por defecto) no se tomarán en cuenta
        'sort'      => ['except' => 'id'],
        'dir'       => ['except' => 'asc'],
        'search'    => ['except' => ''],
    ];

    public function render()
    {
        $postsQuery = Post::where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->dir);   
                        
        if ($this->perPage != -1) { // si se selecciona una paginación
            $posts = $postsQuery->paginate($this->perPage);
        } else { // si se elige mostrar todos los registros           
            $posts = $postsQuery->get();
        }

        return view('livewire.show-posts', compact('posts'));            
    }

    public function updatingSearch() // se ejecuta cada que la propiedad search cambia
    {
        $this->resetPage(); // resetea la paginación para que la búsqueda se haga en todos los registros
    }

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
