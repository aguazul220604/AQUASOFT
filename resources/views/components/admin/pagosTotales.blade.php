@props(['pagostotales'])
<h2 class="mb-3 text-base">Gastión de pagos de servicios</h2>
<p class="text-principal2">Todos los registros disponibles</strong>
</p>
<table id="tablaTotales" class="display">
    <thead class="table">
        <tr>
            <th></th>
            <th>ID</th>
            <th>Titular</th>
            <th>Contacto</th>
            <th>Total</th>
            <th>Fecha de pago</th>
            <th>Servicio</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pagostotales as $pt)
            <tr>
                <td></td>
                <td>{{ $pt->stripe_payment_id }}</td>
                <td>{{ $pt->name }}</td>
                <td>{{ $pt->email }}</td>
                <td>${{ number_format($pt->amount, 2, '.', ',') }}</td>
                <td>{{ $pt->created_at }}</td>
                <td>
                    <div class="text-center">
                        @if ($pt->service == 'service1')
                            <i class="bi-droplet-half"></i>
                        @elseif ($pt->service == 'service2')
                            <i class="bi-house-heart"></i>
                        @elseif ($pt->service == 'service3')
                            <i class="bi-tree"></i>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ asset('js/tables.js') }}"></script>
