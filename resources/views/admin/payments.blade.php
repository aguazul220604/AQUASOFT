@extends('layouts.app2')
@section('sidebar')
    <x-sidebar :usuario="$usuario" />
@endsection
@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="1-tab" data-bs-toggle="tab" data-bs-target="#panel1" type="button"
                role="tab" aria-controls="panel1" aria-selected="true">Albercas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="2-tab" data-bs-toggle="tab" data-bs-target="#panel2" type="button"
                role="tab" aria-controls="panel2" aria-selected="false">Cabañas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="3-tab" data-bs-toggle="tab" data-bs-target="#panel3" type="button"
                role="tab" aria-controls="panel3" aria-selected="false">Camping</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="4-tab" data-bs-toggle="tab" data-bs-target="#panel4" type="button"
                role="tab" aria-controls="panel4" aria-selected="false">Todos los pagos</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="panel1" role="tabpanel" aria-labelledby="1-tab">
            <div class="card shadow-lg h-100" id="content_card">
                <div class="card-body">
                    <div class="table-responsive">
                        <x-admin.pagosAlbercas :pagosalbercas="$pagos_albercas" :date="$date" :year="$year" />
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="panel2" role="tabpanel" aria-labelledby="2-tab">
            <div class="card shadow-lg h-100" id="content_card">
                <div class="card-body">
                    <div class="table-responsive">
                        <x-admin.pagosCabs :pagoscabins="$pagos_cabins" :date="$date" :year="$year" />
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="panel3" role="tabpanel" aria-labelledby="3-tab">
            <div class="card shadow-lg h-100" id="content_card">
                <div class="card-body">
                    <div class="table-responsive">
                        <x-admin.pagosCamping :pagoscamping="$pagos_camping" :date="$date" :year="$year" />
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="panel4" role="tabpanel" aria-labelledby="4-tab">
            <div class="card shadow-lg h-100" id="content_card">
                <div class="card-body">
                    <div class="table-responsive">
                        <x-admin.pagosTotales :pagostotales="$pagos_totales" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
