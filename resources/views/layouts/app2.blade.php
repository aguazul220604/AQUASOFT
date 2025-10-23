<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La Heredad</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/styles2.css') }}">

    <script src="{{ asset('js/script2.js') }}"></script>
    <script src="{{ asset('js/qr_reader.js') }}"></script>
    <script src="{{ asset('js/qr_reader2.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>

<body>
    <div class="d-flex">
        <div>
            @yield('sidebar')
        </div>
        <div class="w-100">
            <nav class="navbar navbar-expand-lg bg-top w-100">
                <button class="btn bg-dashboard ms-2" id="menu-toggle" onclick="toggleSidebar()">
                    <i class="bi bi-list icon-color"></i>
                </button>
                <form action="{{ route('logout') }}" method="POST" class="ms-auto me-3">
                    @csrf
                    <button id="logout-button" type="submit" class="btn">Cerrar sesión
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </nav>
            <div id="main-content" class="fade-in">
                @yield('content')
            </div>
        </div>
    </div>

    <div id="preloader" style="display: none;">
        <div class="spinner-grow bg-footer" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>

</body>

</html>
