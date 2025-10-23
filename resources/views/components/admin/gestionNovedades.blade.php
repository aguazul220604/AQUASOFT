@props(['noticias'])
<h2 class="mb-3 text-base">Gestión de novedades</h2>
<button class="btn btn-dark text-principal" data-bs-toggle="modal" data-bs-target="#modal1">Nuevo anuncio</button>
<BR></BR>
<table id="tablasNovedades" class="display">
    <thead class="table">
        <tr>
            <th></th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($noticias as $noticia)
            <tr>
                <td></td>
                <td>{{ $noticia->descripcion }}</td>
                <td><img src="{{ asset($noticia->img) }}" alt="novedades" class="img-fluid" style="max-width: 150px;"></td>
                <td>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop_{{ $noticia->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <div class="modal fade" id="staticBackdrop_{{ $noticia->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="text-base" id="escanerLabel">Editar novedad</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('noticias.editNovedades') }}" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="container">
                                                @csrf
                                                <input type="hidden" name="ID" value="{{ $noticia->id }}">
                                                <div class="mb-3">
                                                    <label for="Descripcion" class="form-label">Descripción</label>
                                                    <textarea name="Descripcion" id="Descripcion" class="form-control" rows="5">{{ $noticia->descripcion }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Imagen" class="form-label">Imagen</label>
                                                    <input type="file" class="form-control" name="Imagen" id="Imagen">
                                                    <img src="{{ asset($noticia->img) }}" alt="novedades" class="img-fluid" style="max-width: 150px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger text-white"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary text-white"
                                                id="confirmButton">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('noticias.deleteNovedades', $noticia->id) }}" method="POST"
                            class="formEliminar1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-base">Crear nuevo anuncio</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('noticias.createNovedades') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="mb-3">
                            <label for="Descripcion" class="form-label">Descripción</label>
                            <textarea name="Descripcion" id="Descripcion" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" name="Imagen" id="Imagen">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary text-white" id="confirmButton">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/tables.js') }}"></script>
