<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La Heredad</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/styles1.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/script1.js') }}"></script>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>

<body>
    <div id="main-content" class="fade-in">
        @yield('content')
    </div>
    <div id="preloader" style="display: none;">
        <div class="spinner-grow bg-footer" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>
</body>

</html>
