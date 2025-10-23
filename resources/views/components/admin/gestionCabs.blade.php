@props(['reservaciones'])
@props(['rtotales'])
@props(['date'])
@props(['year'])

<h2 class="mb-3 text-base">Control de reservaciones de cabañas</h2>
<form action="{{ route('admin.reservaciones') }}" method="GET">
    <select name="time">
        <option disabled selected>Periodo de tiempo</option>
        <option value="1">Este mes</option>
        <option value="2">Todas las reservaciones</option>
    </select>
    <button type="submit" class="btn btn-dark text-principal">Consultar</button>
</form>
<br>
@if ($rtotales->isNotEmpty())
    <p class="text-principal2">Todos los registros disponibles</strong>
    </p>
@else
    <p class="text-principal2">Mes de consulta en curso:
        <strong>{{ $date }} {{ $year }}</strong>
    </p>
@endif
<br>
<table id="tablaReservaciones" class="display">
    <thead class="table">
        <tr>
            <th></th>
            <th>ID</th>
            <th>ID Pago</th>
            <th>Fecha de ingreso</th>
            <th>Fecha de egreso</th>
            <th>Cantidad de personas</th>
            <th>Cantidad de días</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        @if ($rtotales->isEmpty())
            @foreach ($reservaciones as $res)
                <tr>
                    <td></td>
                    <td>{{ $res->id }}-CABS</td>
                    <td>{{ $res->id_pago }}</td>
                    <td>{{ $res->fecha_ingreso }}</td>
                    <td>{{ $res->fecha_egreso }}</td>
                    <td>{{ $res->cantidad_personas }}</td>
                    <td>{{ $res->cantidad_dias }}</td>
                    <td>
                        <button type="button" class="btn btn-primary text-principal" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop_{{ $res->id }}">
                            Info <i class="bi bi-info-circle-fill"></i>
                        </button>
                        <div class="modal fade" id="staticBackdrop_{{ $res->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalles de reservación
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Cabaña reservada</th>
                                                    <th>Tipo de cabaña</th>
                                                    <th>Personas extra</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $idCabins = explode(',', $res->id_cabins);
                                                    $tipoCabins = explode(',', $res->tipo_cabins);
                                                    $personasExtras = explode(',', $res->personas_extras);
                                                @endphp

                                                @foreach ($idCabins as $index => $idCabin)
                                                    <tr>
                                                        <td>Cabaña {{ $idCabin }}</td>
                                                        <td>
                                                            @if ($tipoCabins[$index] == 1)
                                                                Cabaña sencilla
                                                            @elseif ($tipoCabins[$index] == 2)
                                                                Cabaña sencilla decorada
                                                            @elseif ($tipoCabins[$index] == 3)
                                                                Cabaña doble
                                                            @endif

                                                        </td>
                                                        <td>{{ $personasExtras[$index] ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            @foreach ($rtotales as $rt)
                <tr>
                    <td></td>
                    <td>{{ $rt->id }}-CABS</td>
                    <td>{{ $rt->id_pago }}</td>
                    <td>{{ $rt->fecha_ingreso }}</td>
                    <td>{{ $rt->fecha_egreso }}</td>
                    <td>{{ $rt->cantidad_personas }}</td>
                    <td>{{ $rt->cantidad_dias }}</td>
                    <td>
                        <button type="button" class="btn btn-primary text-principal" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop_{{ $rt->id }}">
                            Info <i class="bi bi-info-circle-fill"></i>
                        </button>
                        <div class="modal fade" id="staticBackdrop_{{ $rt->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalles de reservación
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Cabaña reservada</th>
                                                    <th>Tipo de cabaña</th>
                                                    <th>Personas extra</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $idCabins = explode(',', $rt->id_cabins);
                                                    $tipoCabins = explode(',', $rt->tipo_cabins);
                                                    $personasExtras = explode(',', $rt->personas_extras);
                                                @endphp

                                                @foreach ($idCabins as $index => $idCabin)
                                                    <tr>
                                                        <td>Cabaña {{ $idCabin }}</td>
                                                        <td>
                                                            @if ($tipoCabins[$index] == 1)
                                                                Cabaña sencilla
                                                            @elseif ($tipoCabins[$index] == 2)
                                                                Cabaña sencilla decorada
                                                            @elseif ($tipoCabins[$index] == 3)
                                                                Cabaña doble
                                                            @endif

                                                        </td>
                                                        <td>{{ $personasExtras[$index] ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<script src="{{ asset('js/tables.js') }}"></script>
