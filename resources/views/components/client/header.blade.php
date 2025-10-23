<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-navbar">
        <div class="container-fluid">
            <a class="navbar-brand text-link" href="#">
                <img src="{{ asset('images/img2wp.png') }}" alt="Logo" width="45" height="30"
                    class="d-inline-block align-text-top">
                Centro Ecoturístico La Heredad
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-link-navbar {{ request()->routeIs('inicio') ? 'active' : '' }}"
                            aria-current="page" href="{{ route('inicio') }}" data-preloader>Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-link-navbar {{ request()->routeIs('novedades') ? 'active' : '' }}"
                            href="{{ route('novedades') }}" data-preloader>Novedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-link-navbar {{ request()->routeIs('servicios') ? 'active' : '' }}"
                            href="{{ route('servicios') }}" data-preloader>Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-link-navbar {{ request()->routeIs('hospedaje') ? 'active' : '' }}"
                            href="{{ route('hospedaje') }}" data-preloader>Hospedaje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-link-navbar {{ request()->routeIs('pagos.formulario') ? 'active' : '' }}"
                            href="{{ route('pagos.formulario') }}" data-preloader>
                            <i class="bi bi-ticket-perforated"></i> Comprar boletos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
