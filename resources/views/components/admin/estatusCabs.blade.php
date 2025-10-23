@props(['estatus'])
<h2 class="mb-3 text-base">Estado de reservación de cabañas</h2>
<h6 class="text-elements">Estado:</h6>
<div class="d-flex">
    <div class="d-flex align-items-center justify-content-center">
        <span class="state-indicator available"></span>
        <span class="text-elements">Cabaña disponible</span>
    </div>
</div>
<div class="d-flex">
    <div class="d-flex align-items-center justify-content-center">
        <span class="state-indicator occupied"></span>
        <span class="text-elements">Cabaña ocupada</span>
    </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-around flex-wrap">
                <div class="text-center border border-1 border-dark p-3 m-2" style="width: 150px;">
                    <i class="bi bi-house-heart-fill fs-1 text-base"></i>
                    <h4 class="text-elements">CABAÑA</h4>
                    <br>
                    <h3 class="text-elements">1</h3>
                    <BR></BR>
                    <h6 class="text-elements">ESTADO</h6>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="state-indicator {{ $estatus[0]->estatus == 1 ? 'occupied' : 'available' }}"></span>
                    </div>
                </div>
                <div class="text-center border border-1 border-dark p-3 m-2" style="width: 150px;">
                    <i class="bi bi-house-heart-fill fs-1 text-base"></i>
                    <h4 class="text-elements">CABAÑA</h4>
                    <br>
                    <h3 class="text-elements">2</h3>
                    <BR></BR>
                    <h6 class="text-elements">ESTADO</h6>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="state-indicator {{ $estatus[1]->estatus == 1 ? 'occupied' : 'available' }}"></span>
                    </div>
                </div>
                <div class="text-center border border-1 border-dark p-3 m-2" style="width: 150px;">
                    <i class="bi bi-house-heart-fill fs-1 text-base"></i>
                    <h4 class="text-elements">CABAÑA</h4>
                    <br>
                    <h3 class="text-elements">3</h3>
                    <BR></BR>
                    <h6 class="text-elements">ESTADO</h6>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="state-indicator {{ $estatus[2]->estatus == 1 ? 'occupied' : 'available' }}"></span>
                    </div>
                </div>
                <div class="text-center border border-1 border-dark p-3 m-2" style="width: 150px;">
                    <i class="bi bi-house-heart-fill fs-1 text-base"></i>
                    <h4 class="text-elements">CABAÑA</h4>
                    <br>
                    <h3 class="text-elements">4</h3>
                    <BR></BR>
                    <h6 class="text-elements">ESTADO</h6>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="state-indicator {{ $estatus[3]->estatus == 1 ? 'occupied' : 'available' }}"></span>
                    </div>
                </div>
                <div class="text-center border border-1 border-dark p-3 m-2" style="width: 150px;">
                    <i class="bi bi-house-heart-fill fs-1 text-base"></i>
                    <h4 class="text-elements">CABAÑA</h4>
                    <br>
                    <h3 class="text-elements">5</h3>
                    <BR></BR>
                    <h6 class="text-elements">ESTADO</h6>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="state-indicator {{ $estatus[4]->estatus == 1 ? 'occupied' : 'available' }}"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
