@props(['usuarios'])
<h2 class="mb-3 text-base">Gestión de usuarios del sistema</h2>
<button class="btn btn-dark text-principal" data-bs-toggle="modal" data-bs-target="#modal1">Nuevo usuario</button>
<BR></BR>
<table id="tablasUsers" class="display">
    <thead class="table">
        <tr>
            <th></th>
            <th>Rol</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo electrónico</th>
            <th>Usuario</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td></td>
                <td>
                    @if ($usuario->rol == 1)
                        Administrador
                    @else
                        Colaborador
                    @endif
                </td>
                <td>{{ $usuario->name }} </td>
                <td>{{ $usuario->apellido }} </td>
                <td>{{ $usuario->email }} </td>
                <td>{{ $usuario->user }} </td>
                <td>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop_{{ $usuario->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <div class="modal fade" id="staticBackdrop_{{ $usuario->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="text-base" id="escanerLabel">Editar usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('usuarios.editUser') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="container">
                                                <input type="number" name="id" value="{{ $usuario->id }}" hidden>
                                                <label for="name">Nombre</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    required value="{{ $usuario->name }}">
                                                <br>
                                                <label for="apellido">Apellido</label>
                                                <input type="text" class="form-control" name="apellido"
                                                    id="apellido" required value="{{ $usuario->apellido }}">
                                                <br>
                                                <label for="correo">Correo electrónico</label>
                                                <input type="email" class="form-control" name="correo" id="correo"
                                                    required value="{{ $usuario->email }}">
                                                <br>
                                                <label for="rol">Rol a desempeñar</label>
                                                <select name="rol" id="rol" class="form-select">
                                                    <option disabled {{ !$usuario->rol ? 'selected' : '' }}>Seleccionar
                                                    </option>
                                                    <option value="1" @selected($usuario->rol == 1)>Administrador
                                                    </option>
                                                    <option value="2" @selected($usuario->rol == 2)>Colaborador
                                                    </option>
                                                </select>
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
                        <form action="{{ route('usuarios.deleteUser', $usuario->id) }}" method="POST"
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
                <h1 class="text-base" id="escanerLabel">Crear nuevo usuario del sistema</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('usuarios.createUser') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <br>
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" required>
                        <br>
                        <label for="correo">Correo electrónico</label>
                        <input type="email" class="form-control" name="correo" id="correo" required>
                        <br>
                        <label for="rol">Rol a desempeñar</label>
                        <select name="rol" id="rol" class="form-select" required>
                            <option disabled selected>Seleccionar</option>
                            <option value="1">Administrador</option>
                            <option value="2">Empleado</option>
                        </select>
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
