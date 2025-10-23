@extends('layouts.app1')

@section('content')
    @if (session('message') === 'ok1')
        <script>
            Swal.fire({
                title: "Pago exitoso: Albercas",
                text: "¡Le hemos enviado un correo electrónico con su ticket digital!",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif

    @if (session('message') === 'ok2')
        <script>
            Swal.fire({
                title: "Pago exitoso: Cabañas",
                text: "¡Le hemos enviado un correo electrónico con su ticket digital!",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif

    @if (session('message') === 'ok3')
        <script>
            Swal.fire({
                title: "Pago exitoso: Camping",
                text: "¡Le hemos enviado un correo electrónico con su ticket digital!",
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
    <x-client.header />
    <x-client.div1 />
    <x-client.encabezado4 />
    <x-client.payments :entradas="$entradas" :servicios="$servicios" :cabins="$cabins" :estatus="$estatus" :descuentos="$descuentos"
        :horarios="$horarios" />
    <x-client.footer />
@endsection
