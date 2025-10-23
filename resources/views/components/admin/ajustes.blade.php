@props(['entradas'])
@props(['cabins'])
@props(['servicios'])
@props(['descuentos'])
<h2 class="mb-3 text-base">Configuración de precios</h2>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="text-base text-center">Entradas</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-principal2">Descripción</th>
                            <th scope="col" class="text-principal2">Precio</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entradas as $entrada)
                            <tr>
                                <td class="text-principal2">{{ $entrada->description }}</td>
                                <td>${{ $entrada->precio }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar1{{ $entrada->id }}"
                                        class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <div class="modal fade" id="modalEditar1{{ $entrada->id }}" tabindex="-1"
                                    aria-labelledby="modal1Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="text-base text-center" id="escanerLabel">Editar precio de
                                                    entradas</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('ajustes.updateEntradas', $entrada->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="element"
                                                            class="form-label text-principal2">Descripción
                                                        </label>
                                                        <input type="text" class="form-control" id="element"
                                                            aria-describedby="emailHelp" name="txtdescription"
                                                            value="{{ $entrada->description }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="element" class="form-label text-principal2">Precio
                                                        </label>
                                                        <input type="number" step="0.1" class="form-control"
                                                            id="element" aria-describedby="emailHelp" name="txtprecio"
                                                            value="{{ $entrada->precio }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger text-principal"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit"
                                                            class="btn btn-primary text-white text-principal"
                                                            id="confirmButton">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="text-base text-center">Cabañas</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-principal2">Descripción</th>
                            <th scope="col" class="text-principal2">Precio</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cabins as $cabin)
                            <tr>
                                <td class="text-principal2">{{ $cabin->description }}</td>
                                <td>${{ $cabin->precio }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar2{{ $cabin->id }}"
                                        class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <div class="modal fade" id="modalEditar2{{ $cabin->id }}" tabindex="-1"
                                    aria-labelledby="modal1Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="text-base" id="escanerLabel">Editar precio de cabañas </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('ajustes.updateCabins', $cabin->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="element"
                                                            class="form-label text-principal2">Descripción
                                                        </label>
                                                        <input type="text" class="form-control" id="element"
                                                            aria-describedby="emailHelp" name="txtdescription"
                                                            value="{{ $cabin->description }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="element"
                                                            class="form-label text-principal2">Precio
                                                        </label>
                                                        <input type="number" step="0.1" class="form-control"
                                                            id="element" aria-describedby="emailHelp"
                                                            name="txtprecio" value="{{ $cabin->precio }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger text-principal"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit"
                                                            class="btn btn-primary text-white text-principal"
                                                            id="confirmButton">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="text-base text-center">Servicios</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-principal2">Descripción</th>
                            <th scope="col" class="text-principal2">Precio</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servic)
                            <tr>
                                <td class="text-principal2">{{ $servic->description }}</td>
                                <td>${{ $servic->precio }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar3{{ $servic->id }}"
                                        class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <div class="modal fade" id="modalEditar3{{ $servic->id }}" tabindex="-1"
                                    aria-labelledby="modal1Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="text-base" id="escanerLabel">Editar precio de servicios
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('ajustes.updateServicios', $servic->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="element"
                                                            class="form-label text-principal2">Descripción
                                                        </label>
                                                        <input type="text" class="form-control" id="element"
                                                            aria-describedby="emailHelp" name="txtdescription"
                                                            value="{{ $servic->description }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="element"
                                                            class="form-label text-principal2">Precio
                                                        </label>
                                                        <input type="number" step="0.1" class="form-control"
                                                            id="element" aria-describedby="emailHelp"
                                                            name="txtprecio" value="{{ $servic->precio }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger text-principal"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit"
                                                            class="btn btn-primary text-white text-principal"
                                                            id="confirmButton">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<BR></BR>
<h2 class="mb-3 text-base">Configuración de descuentos</h2>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="text-elements">Promociones</h6>
                <button class="btn btn-dark text-principal" data-bs-toggle="modal"
                    data-bs-target="#modal4">Editar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modal4Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-base" id="escanerLabel">Descuentos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ajustes.updateDescuentos') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <br>
                        <strong>Servicio de Albercas</strong>
                        <div class="row mb-3 align-items-center">
                            <label for="albercas_num_personas"
                                class="col-sm-6 col-form-label text-end text-principal2">
                                Número de personas
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="albercas_num_personas"
                                    id="albercas_num_personas" value="{{ $descuentos[0]->numero_personas }}"
                                    min="0" placeholder="Cantidad" readonly>
                                <input type="hidden" name="albercas_id" value="{{ $descuentos[0]->id }}">
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="albercas_entradas" class="col-sm-6 col-form-label text-end text-principal2">
                                Entradas gratis
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="albercas_entradas"
                                    id="albercas_entradas" value="{{ $descuentos[0]->entradas }}" min="0"
                                    placeholder="Cantidad" required>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="albercas_monto" class="col-sm-6 col-form-label text-end text-principal2">
                                Monto
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="albercas_monto" id="albercas_monto"
                                    value="{{ $descuentos[0]->monto }}" min="0" placeholder="Monto" required>
                            </div>
                        </div>

                        <hr class="border-dark border-4 my-4">

                        <strong>Servicio de Camping</strong>
                        <div class="row mb-3 align-items-center">
                            <label for="camping_num_personas"
                                class="col-sm-6 col-form-label text-end text-principal2">
                                Número de personas
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="camping_num_personas"
                                    id="camping_num_personas" value="{{ $descuentos[1]->numero_personas }}"
                                    min="0" placeholder="Cantidad" readonly>
                                <input type="hidden" name="camping_id" value="{{ $descuentos[1]->id }}">
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="camping_entradas" class="col-sm-6 col-form-label text-end text-principal2">
                                Entradas gratis
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="camping_entradas"
                                    id="camping_entradas" value="{{ $descuentos[1]->entradas }}" min="0"
                                    placeholder="Cantidad" required>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="camping_monto" class="col-sm-6 col-form-label text-end text-principal2">
                                Monto
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="camping_monto" id="camping_monto"
                                    value="{{ $descuentos[1]->monto }}" min="0" placeholder="Monto" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary text-white text-principal" id="confirmButton">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
