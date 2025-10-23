@props(['pagoscamping'])
@props(['date'])
@props(['year'])
<h2 class="mb-3 text-base">Control de pagos: Camping</h2>
<p class="text-principal2">Mes de consulta en curso:
    <strong>{{ $date }} {{ $year }}</strong>
</p>
<table id="tablaCamping" class="display">
    <thead class="table">
        <tr>
            <th></th>
            <th>ID</th>
            <th>Titular</th>
            <th>Contacto</th>
            <th>Total</th>
            <th>Fecha de pago</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pagoscamping as $pcp)
            <tr>
                <td></td>
                <td>{{ $pcp->stripe_payment_id }}</td>
                <td>{{ $pcp->name }}</td>
                <td>{{ $pcp->email }}</td>
                <td>${{ number_format($pcp->amount, 2, '.', ',') }}</td>
                <td>{{ $pcp->created_at }}</td>
                <td>
                    <button type="button" class="btn btn-primary text-principal" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop_{{ $pcp->stripe_payment_id }}">
                        Info <i class="bi bi-info-circle-fill"></i>
                    </button>
                    <div class="modal fade" id="staticBackdrop_{{ $pcp->stripe_payment_id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalles</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-unstyled">
                                        <li class="d-flex justify-content-between">
                                            <span>Cantidad de personas</span>
                                            <strong>{{ $pcp->cantidad_personas }}</strong>
                                        </li>
                                        <hr class="border-dark border-4 my-4">
                                        <li class="d-flex justify-content-between">
                                            <span>Descuentos:</span>
                                            <strong>{{ $pcp->descuentos }}</strong>
                                        </li>
                                    </ul>
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
    </tbody>
</table>
