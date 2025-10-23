@extends('layouts.app2')
@section('sidebar')
    <x-sidebar :usuario="$usuario" />
@endsection
@section('content')
    @if (session('message') === 'ok')
        <script>
            Swal.fire({
                text: "¡Bienvenido!",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif

    <div class="d-flex justify-content-center align-items-center text-center" style="height: 85vh;">
        <div class="mt-3">
            <h1 class="text-base">Centro Ecoturístico La Heredad</h1>
            <h3 class="text-principal2 mt-4">¡Relajación y contacto natural!</h3>
            <img src="{{ asset('images/img2wp.png') }}" alt="" class="mt-5">
        </div>
    </div>
@endsection
