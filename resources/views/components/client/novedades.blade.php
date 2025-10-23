@props(['noticias'])
@foreach ( $noticias as $noticia )
<div class="container mt-4 mb-4">
    <div class="text-description mb-4">
        <i class="bi bi-droplet-half fs-1 text-success"></i>
        <h2>{{$noticia->descripcion}}</h2>
    </div>
    <div class="image-container">
        <img src="{{ asset($noticia->img) }}" alt="novedades" class="img-fluid ">
    </div>
</div>
@endforeach
