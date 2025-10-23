<div class="text-center mt-5"> 
    <h2 class="mb-5 text-base">Verificación de tickets</h2>
    <button type="button" class="btn btn-dark text-principal mt-5" data-bs-toggle="modal" data-bs-target="#escaner">
        Escanear ticket
    </button>
             
    <div class="modal fade" id="escaner" tabindex="-1" aria-labelledby="escanerLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="text-base" id="escanerLabel">Escanear ticket</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('procesarTicket') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div id="reader" style="width: 100%;"></div>
                            <div id="qr-result" class="mt-3">
                                <p><strong class="text-principal2">Información del ticket:</strong></p>
                                <br>
                                <label for="id_pago" class="text-principal2">ID Pago</label>
                                <input type="text" name="id_pago" id="qr-content1" class="input_escaner"
                                    value="" readonly>
                                <br>
                                <input type="text" name="tipo_servicio" id="qr-content2" class="text-principal2"
                                    value="" readonly hidden>
                                <br>
                                <div id="servicios">
                                    <i id="service" class=""></i>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-principal"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary text-principal"
                                id="confirmButton">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>




