    @props(['tickets'])
    @props(['selectedtickets'])
    @props(['servicetype'])

    <h2 class="mb-3 text-base">Control de tickets por servicio</h2>
    <form action="{{ route('admin.tickets') }}" method="GET">
        <select name="service_type">
            <option disabled selected>Seleccionar servicio</option>
            <option value="1">Albercas</option>
            <option value="2">Cabañas</option>
            <option value="3">Camping</option>
        </select>
        <button type="submit" class="btn btn-dark text-principal">Consultar</button>
    </form>
    <br>
    @php
        $servicios = [
            1 => 'Albercas',
            2 => 'Cabañas',
            3 => 'Camping',
        ];
    @endphp
    @if ($selectedtickets->isNotEmpty())
        <p class="text-principal2">Servicio seleccionado:
            <strong>{{ $servicios[$servicetype] ?? 'Desconocido' }}</strong>
        </p>
    @else
        @php
            $today = now()->toDateString();
        @endphp
        <p class="text-principal2">Fecha de hoy:
            <strong>{{ $today }}</strong>
        </p>
    @endif
    <br>
    <table id="tablaTickets">
        <thead class="table">
            <tr>
                <th>ID</th>
                <th>ID Pago</th>
                <th>Servicio</th>
                <th>Fecha de lectura</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @if ($selectedtickets->isEmpty())
                @foreach ($tickets as $tk)
                    <tr>
                        <td>{{ $tk->id }}</td>
                        <td>{{ $tk->id_pago }}</td>
                        <td>{{ $servicios[$tk->service_number] ?? 'Desconocido' }}</td>
                        <td>{{ $tk->fecha_escanner }}</td>
                        <td>{{ $tk->estado == 1 ? 'Escaneado' : 'Error' }}</td>
                    </tr>
                @endforeach
            @else
                @foreach ($selectedtickets as $st)
                    <tr>
                        <td>{{ $st->id }}</td>
                        <td>{{ $st->id_pago }}</td>
                        <td>{{ $servicios[$st->service_number] ?? 'Desconocido' }}</td>
                        <td>{{ $st->fecha_escanner }}</td>
                        <td>{{ $st->estado == 1 ? 'Escaneado' : 'Error' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <script src="{{ asset('js/tables.js') }}"></script>
