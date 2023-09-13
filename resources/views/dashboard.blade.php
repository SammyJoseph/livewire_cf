<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @php $mensaje1 = "Hola mundo 1" @endphp
                <p class="font-bold">Primera llamada al componente (Mensaje 3 está tomando el valor de $mensaje1 usando el método mount())</p>
                <livewire:show-posts :mensaje1="$mensaje1" /> 
                {{-- @livewire('show-posts', ["mensaje1" => $mensaje1]) --}} {{-- ↑↓ --}}

                {{-- <p class="font-bold">Segunda llamada al componente (Mensaje 3 está tomando el valor por defecto del método mount())</p> --}}
                {{-- <livewire:show-posts mensaje2="Hola mundo 2" /> --}} {{-- si se envía un string, no se agrega los dos puntos al nombre de variable (mensaje2) --}}
            </div>
        </div>
    </div>
</x-app-layout>
