@props(['entradas'])
@props(['servicios'])
@props(['cabins'])
@props(['estatus'])
@props(['descuentos'])
@props(['horarios'])

<form action="{{ route('pagos.processPayment') }}" method="POST" id="payment-form">
    @csrf
    <div class="servicios">
        <!-- Nombre -->
        <label for="name">Nombre completo</label>
        <input type="text" name="name" id="name" required>
        <br>
        <!-- Correo -->
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" required>
        <br>
        <!-- Servicio -->
        <label for="service">¿Cuál sería el motivo de su visita?</label>
        <select name="service" id="service">
            <option value="service1">Albercas</option>
            <option value="service2">Cabañas</option>
            <option value="service3">Camping</option>
        </select>
    </div>
    <br>

    <!-- Albercas -->
    <div id="form-service1" class="servicios">
        <label for="edad1">
            Niños menores a 3 años <strong>${{ $entradas[0]->precio }}</strong>
        </label>
        <input type="number" name="edad1" id="edad1" value="0" min="0"
            data-price-ed1="{{ $entradas[0]->precio }}">
        <br>
        <label for="edad2">
            Adultos y niños <strong>${{ $entradas[1]->precio }}</strong>
        </label>
        <input type="number" name="edad2" id="edad2" value="0" min="0"
            data-price-ed2="{{ $entradas[1]->precio }}">
        <br>
        <label for="edad3">
            Adultos mayores <strong>${{ $entradas[2]->precio }}</strong>
        </label>
        <input type="number" name="edad3" id="edad3" value="0" min="0"
            data-price-ed3="{{ $entradas[2]->precio }}">

        <label for="total_personas1" hidden>
            <strong>Total de personas</strong>
        </label>
        <input type="number" name="total_personas1" id="total_personas1" value="0" hidden>

        <label for="total_personas2" hidden>
            Total de personas 2
        </label>
        <input type="number" name="total_personas2" id="total_personas2" value="{{ $descuentos[0]->numero_personas }}"
            data-personas="{{ $descuentos[0]->numero_personas }}" hidden>

        <label for="entradas_gratis" hidden>
            Entradas gratis
        </label>
        <input type="number" name="entradas_gratis" id="entradas_gratis" value="0"
            data-entradas="{{ $descuentos[0]->entradas }}" hidden>

        <label for="monto_gratis">
            Descuento
        </label>
        <input type="number" name="monto_gratis" id="monto_gratis" value="0"
            data-monto="{{ $descuentos[0]->monto }}" readonly>
        <p>Aplica por cada 10 personas descuento de ${{ $descuentos[0]->monto }}</p>
        <br>
        <label for="total1">Total a pagar</label>
        <input type="text" id="total1" name="total1" value="0" readonly>
    </div>
    <!-- Cabañas -->
    @if ($estatus->isNotEmpty())
        <div id="form-service2" class="hidden servicios">
            <label for="ccd" hidden>Cantidad de cabañas disponibles</label>
            <input type="text" name="cantidad_cabins_disponibles" id="ccd" readonly
                value="{{ $estatus->count() }}" hidden>

            <label for="tipo_cabs">Tipo de cabaña</label>
            <select name="tipo_cabs" id="tipo_cabs">
                <option value="1" data-price-cb1="{{ $cabins[0]->precio }}" id="cab1">
                    {{ $cabins[0]->description }} (para 2 personas) <strong>${{ $cabins[0]->precio }}</strong>
                </option>
                <option value="2" data-price-cb2="{{ $cabins[1]->precio }}" id="cab2">
                    {{ $cabins[1]->description }} (para 2 personas) <strong>${{ $cabins[1]->precio }}</strong>
                </option>
                <option value="3" data-price-cb3="{{ $cabins[2]->precio }}" id="cab3">
                    {{ $cabins[2]->description }} (para 4 personas) <strong>${{ $cabins[2]->precio }}</strong>
                </option>
            </select>

            <label for="numero_personas_cabs">Cantidad de personas</label>
            <input type="number" name="numero_personas_cabs" id="npcb" value="1" min="1">

            <p id="mensaje_alert" class="hidden">
                La cantidad de personas es superior a la capacidad de alojamiento de las cabañas
            </p>

            <div id="cabins_reservadas_cont">
                <label for="cabs_reservadas">Cabañas reservadas</label>
                <input type="number" name="cabs_reservadas" id="cr" value="0" readonly>
            </div>

            <div id="alerta_pe" class="hidden">
                <label for="personas_extra">Personas extra</label>
                <input type="number" name="personas_extra" id="pe" value="0" readonly>
                <p>El costo por persona extra es de $100.00 </p>
            </div>

            <label for="fecha_reservacion">Fecha de reservación</label>
            <input type="date" name="fecha_reservacion" id="frc">

            <label for="dias_reservacion">Días de reservación</label>
            <input type="number" name="dias_reservacion" id="drc" value="1" min="1">

            <label for="servicio_extra">¿Le gustaría reservar un baño de vapor?</label>
            <select name="servicio_extra" id="servicio_extra">
                <option disabled selected>Seleccionar</option>
                <option value="1">Sí</option>
                <option value="2">No</option>
            </select>

            <div class="hidden" id="horario_se">
                <label for="horario_se">Horario</label>
                <select name="horario_se" id="horario_se_select">
                    @foreach ($horarios as $horario)
                        <option value="{{ $horario->id }}">{{ $horario->hora }}</option>
                    @endforeach
                </select>
            </div>



            <label for="total2">Total a pagar</label>
            <input type="text" id="total2" name="total2" value="0" readonly>
        </div>
    @else
        <div id="no-cabins-message" class="hidden servicios">
            <label>No hay cabañas disponibles</label>
        </div>
    @endif
    <!-- Camping -->
    <div id="form-service3" class="hidden servicios">
        <label for="numero_personas_camping">
            Cantidad de personas <strong>${{ $servicios[0]->precio }}</strong>
        </label>
        <input type="number" name="numero_personas_camping" id="npc" value="0" min="0"
            data-price3="{{ $servicios[0]->precio }}">
        <label for="total_personas2_camp" hidden>
            Total de personas 2
        </label>
        <input type="number" name="total_personas2_camp" id="total_personas2_camp"
            value="{{ $descuentos[1]->numero_personas }}" data-personas2="{{ $descuentos[1]->numero_personas }}"
            hidden>
        <label for="entradas_gratis2" hidden>
            Entradas gratis
        </label>
        <input type="number" name="entradas_gratis2" id="entradas_gratis2" value="0"
            data-entradas2="{{ $descuentos[1]->entradas }}" hidden>
        <label for="monto_gratis2">
            Descuento
        </label>
        <input type="number" name="monto_gratis2" id="monto_gratis2" value="0"
            data-monto2="{{ $descuentos[1]->monto }}" readonly>
        <p>Aplica por cada 10 personas descuento de ${{ $descuentos[1]->monto }}</p>
        <br>
        <label for="total3">Total a pagar</label>
        <input type="text" id="total3" name="total3" value="0" readonly>
    </div>
    <br>
<!-- Tarjeta --> 
<div class="servicios">
    <label for="card-element">Detalles de la tarjeta</label>
    <div id="card-element"></div>
    <div id="card-errors" style="color: red; margin-top: 10px;"></div>
    <br>
    <!-- Pagar -->
    <button type="submit" id="pay-button" disabled>Pagar</button>
</div>
<BR></BR>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/dinamic_form.js') }}"></script>
