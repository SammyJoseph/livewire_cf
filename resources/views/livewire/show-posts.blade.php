<div>
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
        @component('components.posts.search-input') @endcomponent
        {{-- <x-posts.search-input /> --}} {{-- ↑↓ --}}

        @if ($posts->count())
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
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="bg-blue-500 border-b border-blue-400">
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
                                <a href="#" class="font-medium text-white hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil w-4 -mt-1 inline-block" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                        <path d="M13.5 6.5l4 4" />
                                    </svg>
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach                
                </tbody>
            </table>
        @else
            <div class="text-xs text-white uppercase bg-blue-600 mt-4 p-4">No se encontraron resultados</div>
        @endif
        
    </div>
</div>
