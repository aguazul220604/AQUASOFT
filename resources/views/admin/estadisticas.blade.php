@extends('layouts.app2')
@section('sidebar')
    <x-sidebar :usuario="$usuario" />
@endsection
@section('content')

<div class="card shadow-lg h-100" id="content_card">
                <div class="card-body">
                <h2 class="mb-3 text-base">Estadísticas de demanda mensual</h2>
        <p class="text-principal2">Fecha de consulta actual:
            <strong>{{ $date }} {{ $year }}</strong>
        </p>
        <br>

        <div class="row justify-content-center align-items-center w-90">
            <div class="col-12 col-md-6 col-lg-5 text-center mb-4">
                <canvas id="gains" class="w-100 h-auto"></canvas>
            </div>
            <div class="col-12 col-md-6 col-lg-5 text-center mb-4">
                <canvas id="months" class="w-100 h-auto"></canvas>
            </div>
            <div class="col-12 col-md-6 col-lg-5 text-center mt-3">
                <canvas id="ages" class="w-100 h-auto"></canvas>
            </div>
            <div class="col-12 col-md-6 col-lg-5 text-center mt-3">
                <canvas id="services" class="w-100 h-auto"></canvas>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var chrt1 = document.getElementById('ages').getContext('2d');
                var chart1 = new Chart(chrt1, {
                    type: 'doughnut',
                    data: {
                        labels: ['Niños menores a 3 años', 'Niños y adultos', 'Adultos mayores'],
                        datasets: [{
                            label: 'Cantidad de personas',
                            data: [{{ $ages[0] }}, {{ $ages[1] }}, {{ $ages[2] }}],
                            backgroundColor: ['#7ccca1', '#268d51 ', '#034720'],
                            hoverOffset: 5
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Análisis de grupos poblacionales'
                            }
                        }
                    },
                });

                var chrt2 = document.getElementById('services').getContext('2d');
                var chart2 = new Chart(chrt2, {
                    type: 'bar',
                    data: {
                        labels: ['Albercas', 'Cabañas', 'Camping'],
                        datasets: [{
                            label: 'Cantidad de tickets',
                            data: [{{ $services[0] }}, {{ $services[1] }}, {{ $services[2] }}],
                            backgroundColor: ['#7ccca1', '#268d51 ', '#034720'],
                            hoverOffset: 5
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Tickets vendidos por servicio'
                            }
                        }
                    },
                });

                var chrt3 = document.getElementById('gains').getContext('2d');
                var chart3 = new Chart(chrt3, {
                    type: 'bar',
                    data: {
                        labels: ['Albercas', 'Cabañas', 'Camping'],
                        datasets: [{
                            label: '$',
                            data: [{{ $gains[0] }}, {{ $gains[1] }}, {{ $gains[2] }}],
                            backgroundColor: ['#7ccca1', '#268d51', '#034720'],
                            hoverOffset: 5
                        }],
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Ganancias ecónomicas del mes en curso'
                            }
                        }
                    },
                });


                var chrt4 = document.getElementById('months').getContext('2d');
                var chart4 = new Chart(chrt4, {
                    type: 'line',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'
                        ],
                        datasets: [{
                            label: '$',
                            data: [{{ $sumsByMonth['Enero'] }}, {{ $sumsByMonth['Febrero'] }},
                                {{ $sumsByMonth['Marzo'] }}, {{ $sumsByMonth['Abril'] }},
                                {{ $sumsByMonth['Mayo'] }},
                                {{ $sumsByMonth['Junio'] }}, {{ $sumsByMonth['Julio'] }},
                                {{ $sumsByMonth['Agosto'] }}, {{ $sumsByMonth['Septiembre'] }},
                                {{ $sumsByMonth['Octubre'] }},
                                {{ $sumsByMonth['Noviembre'] }}, {{ $sumsByMonth['Diciembre'] }}
                            ],
                            backgroundColor: ['#7ccca1', '#268d51', '#034720'],
                            hoverOffset: 5
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Ganancias totales del año en curso'
                            }
                        }
                    },
                });


            });
        </script>

                </div>
            </div>
@endsection