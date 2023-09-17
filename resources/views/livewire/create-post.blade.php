<div x-data="{ open : @entangle('isOpenModal'), openToast : @entangle('isOpenToast') }" {{-- @entangle se sincroniza con la variable isOpen de livewire en CreatePost --}}
    class="col-span-6 sm:col-span-2">
    <button type="button" @click="open = true"
        class="text-white uppercase bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Crear Post
    </button>

    <!-- Create post - Modal -->
    <div x-show="open" x-cloak
        class="fixed top-0 left-0 flex items-center justify-center w-screen h-screen bg-gray-800 bg-opacity-50 z-10">
        <form tabindex="-1" aria-hidden="true" @click.outside="open = false" wire:submit="store"
            class="w-full p-4 overflow-x-hidden overflow-y-auto max-w-lg bg-white shadow-lg rounded-lg">
            <div class="relative w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" @click="open = false"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Crear nuevo post</h3>
                        <form class="space-y-6" action="#">
                            <div>
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                                <input type="text" name="title" id="title" wire:model="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Escribe el título del nuevo post" required>
                                @error('title')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="my-4">
                                <label for="message"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenido</label>
                                <textarea id="message" rows="4" required wire:model="content"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Escribe el contenido del nuevo post"></textarea>
                                @error('content')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4"> {{-- Imagen --}}
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Imagen</label>
                                <input wire:model="image" required
                                    id="postImage-input"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or WEBP</p>
                                @error('image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div> {{-- Vista previa de imagen --}}
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" alt="">
                                @endif

                                <div wire:loading.flex wire:target="image"
                                    class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                      <span class="font-medium">Cargando imagen.</span> Espere unos segundos.
                                    </div>
                                </div>
                                <script>
                                    // Escuchar el evento livewire resetFileInput desde CreatePost
                                    // para limpiar el nombre del archivo seleccionado en el input image
                                    document.addEventListener('livewire:initialized', () => {
                                        @this.on('resetFileInput', (event) => {
                                            const fileInput = document.querySelector('#postImage-input');
                                            fileInput.value = '';
                                        });
                                    });
                                </script>
                            </div>

                            <button type="submit" wire:loading.attr="disabled" wire:target="save, image"
                                class="disabled:opacity-50 w-full uppercase text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Crear Post
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy inline-block -mt-0.5 w-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Success toast -->
    <div class="fixed top-32 left-1/2 transform -translate-x-1/2 z-20" x-show="openToast" x-cloak>
        <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">Se registró con éxito.</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
</div>
