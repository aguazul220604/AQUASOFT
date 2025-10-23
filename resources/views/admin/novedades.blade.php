@extends('layouts.app2')
@section('sidebar')
<x-sidebar :usuario="$usuario" />
@endsection
@section('content')
    @if (session('message') === 'ok')
        <script>
            Swal.fire({
                text: "Datos registrados",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session('message') === 'update')
        <script>
            Swal.fire({
                text: "Datos actualizados",
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
    <div class="card shadow-lg h-100" id="content_card">
        <div class="card-body">
            <div class="table-responsive">
                <x-admin.gestionNovedades :noticias="$noticias" />
            </div>
        </div>
    </div>
@endsection
