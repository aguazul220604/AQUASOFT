<div id="sidebar" class="sidebar d-flex flex-column align-items-center" style="min-height: 100vh;">
    <div class="logo p-3">
        <img src="{{ asset('images/img2wp.png') }}" alt="Logo" width="50px;" height="30px;" class="logo-img">
        <p class="link-text text-sidebar mb-0">Centro Ecoturístico</p>
        <p class="link-text text-sidebar mt-0">La Heredad</p>
    </div>
    <ul class="nav flex-column mt-4 w-100">
        <li class="nav-item">
            <a href="{{ route('admin.tickets') }}"
                class="nav-link text-white d-flex align-items-center
                {{ request()->routeIs('admin.tickets') ? 'active' : '' }}"
                data-preloader>
                <i class="bi bi-ticket-perforated icon"></i>
                <span class="ms-2 link-text text-sidebar">Tickets</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.payments') }}"
                class="nav-link text-white d-flex align-items-center
                {{ request()->routeIs('admin.payments') ? 'active' : '' }}"
                data-preloader>
                <i class="bi bi-coin icon"></i>
                <span class="ms-2 link-text text-sidebar">Pagos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.reservaciones') }}"
                class="nav-link text-white d-flex align-items-center
                {{ request()->routeIs('admin.reservaciones') ? 'active' : '' }}"
                data-preloader>
                <i class="bi bi-house-heart-fill icon"></i>
                <span class="ms-2 link-text text-sidebar">Reservaciones</span>
            </a>
        </li>
        @if ($usuario->rol == 1)
            <li class="nav-item">
                <a href="{{ route('admin.estadisticas') }}"
                    class="nav-link text-white d-flex align-items-center
                    {{ request()->routeIs('admin.estadisticas') ? 'active' : '' }}"
                    data-preloader>
                    <i class="bi bi-bar-chart-fill icon"></i>
                    <span class="ms-2 link-text text-sidebar">Estadísticas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.ajustes') }}"
                    class="nav-link text-white d-flex align-items-center
                    {{ request()->routeIs('admin.ajustes') ? 'active' : '' }}"
                    data-preloader>
                    <i class="bi bi-gear icon"></i>
                    <span class="ms-2 link-text text-sidebar">Ajustes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.novedades') }}"
                    class="nav-link text-white d-flex align-items-center
                    {{ request()->routeIs('admin.novedades') ? 'active' : '' }}"
                    data-preloader>
                    <i class="bi bi-newspaper icon"></i>
                    <span class="ms-2 link-text text-sidebar">Novedades</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('usuarios') }}"
                    class="nav-link text-white d-flex align-items-center
                    {{ request()->routeIs('usuarios') ? 'active' : '' }}"
                    data-preloader>
                    <i class="bi bi-people icon"></i>
                    <span class="ms-2 link-text text-sidebar">Usuarios</span>
                </a>
            </li>
        @endif
    </ul>
</div>
