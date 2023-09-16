<div x-data="{ openToastEdit : @entangle('isOpenEditToast') }">
    {{-- <p>{{ $mensaje1 }}</p>
    <p>{{ $mensaje2 }}</p>
    <p>{{ $mensaje3 }}</p>

    <!-- Imprimir parámetro enviado desde la ruta -->
    <p>{{ $nombre }}</p>

    <p class="font-bold">Registros de la BD</p>
    @foreach ($posts as $post)
        <ul>
            <li><span>{{ $loop->iteration }}</span> {{ $post->title }}</li>
        </ul>
    @endforeach --}}


    <div class="relative overflow-x-auto">
        <div class="grid grid-cols-12 gap-4 items-center justify-items-end">
            @component('components.posts.search-input') @endcomponent
            {{-- <x-posts.search-input /> --}} {{-- ↑↓ --}}
            
            @livewire('create-post')
        </div>

        <div class="relative">
            @if ($posts->count())
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
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="bg-blue-500 border-b border-blue-400" wire:key="{{ $post->id }}"> {{-- wire:key ayuda en la reordenación del datatable --}}
                                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                    {{ $post->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $post->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $post->content }}
                                </td>
                                <td class="px-6 py-4">
                                    @livewire('edit-post', ['post' => $post], key($post->id)) {{-- key ayuda al renderizar la primera vez --}}
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
            @else
                <div class="text-xs text-white uppercase bg-blue-600 mt-4 p-4">No se encontraron resultados</div>
            @endif
        </div>
    </div>

    <!-- Edit toast -->
    <div class="fixed top-32 left-1/2 transform -translate-x-1/2 z-20" x-show="openToastEdit" x-cloak>
        <div id="toastedit-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">Se actualizó con éxito.</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toastedit-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
</div>
