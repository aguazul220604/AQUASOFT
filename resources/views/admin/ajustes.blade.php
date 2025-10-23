@extends('layouts.app2')
@section('sidebar')
    <x-sidebar :usuario="$usuario" />
@endsection
@section('content')
    @if (session('message') === 'update1')
        <script>
            Swal.fire({
                text: "Precios de entradas actualizados",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session('message') === 'update2')
        <script>
            Swal.fire({
                text: "Precios de cabañas actualizados",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session('message') === 'update3')
        <script>
            Swal.fire({
                text: "Precios de servicios actualizados",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session('message') === 'update4')
        <script>
            Swal.fire({
                text: "Descuentos actualizados",
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
    <div class="card shadow-lg" id="content_card3">
        <div class="card-body">
            <x-admin.ajustes :entradas="$entradas" :cabins="$cabins" :servicios="$servicios" :descuentos="$descuentos" />
        </div>
    </div>
@endsection
