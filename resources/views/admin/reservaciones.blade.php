@extends('layouts.app2')
@section('sidebar')
    <x-sidebar :usuario="$usuario" />
@endsection
@section('content')
    @if (session('message') === 'ok')
        <script>
            Swal.fire({
                text: "Reservación concluida",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                text: "{{ $errors->first() }}",
                icon: "warning",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="1-tab" data-bs-toggle="tab" data-bs-target="#panel1" type="button"
                role="tab" aria-controls="panel1" aria-selected="true">Gestión de reservaciones</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="2-tab" data-bs-toggle="tab" data-bs-target="#panel2" type="button"
                role="tab" aria-controls="panel2" aria-selected="false">Lectura de reservación</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="3-tab" data-bs-toggle="tab" data-bs-target="#panel3" type="button"
                role="tab" aria-controls="panel3" aria-selected="false">Estatus de cabañas</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="panel1" role="tabpanel" aria-labelledby="1-tab">
            <div class="card shadow-lg h-100" id="content_card">
                <div class="card-body">
                    <x-admin.gestionCabs :reservaciones="$reservaciones" :date="$date" :year="$year" :rtotales="$reservaciones_totales" />
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="panel2" role="tabpanel" aria-labelledby="2-tab">
            <div class="card shadow-lg" id="content_card">
                <div class="card-body">
                    <div class="table-responsive">
                        <x-admin.lectorCabins />
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="panel3" role="tabpanel" aria-labelledby="3-tab">
            <div class="card shadow-lg" id="content_card">
                <div class="card-body">
                    <div class="table-responsive">
                        <x-admin.estatusCabs :estatus="$estatus" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
