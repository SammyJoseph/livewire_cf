<div>
    <p>{{ $mensaje1 }}</p>
    <p>{{ $mensaje2 }}</p>
    <p>{{ $mensaje3 }}</p>

    <!-- Imprimir parámetro enviado desde la ruta -->
    <p>{{ $nombre }}</p>

    <p class="font-bold">Registros de la BD</p>
    @foreach ($posts as $post)
        <ul>
            <li><span>{{ $loop->iteration }}</span> {{ $post->title }}</li>
        </ul>
    @endforeach
</div>
