<div wire:init="loadPosts" x-data="{ openToastEdit : @entangle('isOpenEditToast'), openToastDelete : @entangle('isOpenDeleteToast') }">
    <div class="relative overflow-x-auto">
        <div class="grid grid-cols-12 gap-4 items-center justify-items-end pt-1">

            {{-- Barra de búsqueda --}}
            @component('components.posts.search-input') @endcomponent

            {{-- Cantidad de productos --}}
            <div class="col-span-6 sm:col-span-2">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white sr-only">Select an option</label>
                <select wire:model.live="perPage"
                    id="countries" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="-1">Todos</option>
                </select>
            </div>
            
            {{-- Botón & modal crear post --}}
            @livewire('create-post')

        </div>

        {{-- Tabla de posts --}}
        <div class="relative">
            @if (count($posts))
                <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100 mt-4">
                    <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                        <tr x-data="{ id_asc: true, id_desc: false, ti_asc: false, ti_desc: false, co_asc: false, co_desc: false }">
                            <th scope="col" class="px-6 py-3 flex cursor-pointer"
                                wire:click="sortTable('id')"
                                @click="
                                    id_asc = !id_asc; id_desc = !id_asc
                                    ti_asc = false; ti_desc = false;
                                    co_asc = false; co_desc = false">
                                ID
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-descending-2 w-4 ml-1" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    x-show="id_asc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 5m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M5 14m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M14 15l3 3l3 -3" />
                                    <path d="M17 18v-12" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-ascending-2 w-4 ml-1" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    x-show="id_desc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M14 9l3 -3l3 3" />
                                    <path d="M5 5m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M5 14m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M17 6v12" />
                                </svg>
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer"
                                wire:click="sortTable('title')"
                                @click="
                                    id_asc = false; id_desc = false;
                                    ti_asc = !ti_asc; ti_desc = !ti_asc;
                                    co_asc = false; co_desc = false">
                                Título
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-descending-2 inline-block w-4 ml-1 -mt-0.5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    x-show="ti_asc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 5m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M5 14m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M14 15l3 3l3 -3" />
                                    <path d="M17 18v-12" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-ascending-2 inline-block w-4 ml-1 -mt-0.5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    x-show="ti_desc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M14 9l3 -3l3 3" />
                                    <path d="M5 5m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M5 14m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M17 6v12" />
                                </svg>
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer"
                                wire:click="sortTable('content')"
                                @click="
                                    id_asc = false; id_desc = false;
                                    ti_asc = false; ti_desc = false;
                                    co_asc = !co_asc; co_desc = !co_asc">
                                Contenido
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-descending-2 inline-block w-4 ml-1 -mt-0.5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    x-show="co_asc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 5m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M5 14m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M14 15l3 3l3 -3" />
                                    <path d="M17 18v-12" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-ascending-2 inline-block w-4 ml-1 -mt-0.5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    x-show="co_desc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M14 9l3 -3l3 3" />
                                    <path d="M5 5m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M5 14m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z" />
                                    <path d="M17 6v12" />
                                </svg>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Imagen
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="bg-blue-500 border-b border-blue-400" wire:key="{{ $post->id }}"> {{-- wire:key ayuda al reordenar el datatable --}}
                                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                    {{ $post->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $post->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {!! $post->content !!}
                                </td>
                                <td class="px-6 h-40">
                                    <img class="object-contain max-h-full" src="{{ Storage::url($post->image) }}" alt="">
                                </td>
                                <td class="px-6 py-4">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}} {{-- key ayuda al renderizar la primera vez --}}
                                    
                                    {{-- en lugar de llamar a un componente (incluido modal) para cada fila, se llamará a un solo componente enviando datos en cada click ↑↓ --}}
                                    <button type="button" wire:click="editModal({{ $post }})"
                                        class="font-medium text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil w-5 inline-block" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                            <path d="M13.5 6.5l4 4" />
                                        </svg>
                                    </button>
                                    <button type="button" wire:click="deleteModal({{ $post }})"
                                        class="font-medium text-white ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser w-5 inline-block" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        
                        {{-- Spinner de carga de livewire al hacer filtros --}}
                        <div wire:loading class="w-full h-full bg-white/20 absolute left-0 top-0 z-10">
                            <div role="status" class="absolute -translate-x-1/2 left-1/2 top-40">
                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </tbody>
                </table>

                {{-- Paginación --}}
                @if (method_exists($posts, 'hasPages') && $posts->hasPages())
                    <div class="px-6 py-3">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                {{-- <div class="text-xs text-white uppercase bg-blue-600 mt-4 p-4">No se encontraron resultados</div> --}}      
                {{-- lazy load table --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100 mt-4">
                        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Título
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Contenido
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Imagen
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-blue-500 border-b border-blue-400">
                                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                    Cargando
                                </th>
                                <td class="px-6 py-4">
                                    Cargando...
                                </td>
                                <td class="px-6 py-4">
                                    Cargando...
                                </td>
                                <td class="px-6 py-4 h-24">
                                    <img class="object-contain max-h-full" src="{{ asset('posts/images/lazy-img.png') }}" alt="">
                                </td>
                                <td class="px-6 py-4">
                                    Cargando...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif            
        </div>
    </div>

    {{-- Edit post - Modal --}}
    @if ($epost) {{-- $epost es el Post enviado al dar clic en el botón editar de cada post --}}
        @component('components.posts.edit-post-form', ['title' => $title, 'content' => $content, 'image' => $image]) @endcomponent
    @endif

    {{-- Delete post - Modal --}}
    @if ($dpost) {{-- $dpost es el Post enviado al dar clic en el botón eliminar de cada post --}}
        @component('components.posts.delete-post-form') @endcomponent
    @endif

    {{-- Confirmation toasts --}}
    @include('_partials.toasts')

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('loadCKEditor', (event) => {
                setTimeout(() => {
                    ClassicEditor
                        .create( document.querySelector( '#ckeditor_e' ) )
                        .then( function(ckeditor_e){ // sincronizar variable $content con el contenido del textarea ckeditor_e
                            ckeditor_e.model.document.on('change:data', () => {
                                @this.set('content', ckeditor_e.getData())
                            })
                        } )
                        .catch( error => {
                            console.error( error );
                        } );
                }, 100);
            });
        });
    </script>  
</div>