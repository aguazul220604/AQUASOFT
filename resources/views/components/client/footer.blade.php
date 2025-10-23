<div class="container-fluid bg-footer">
    <footer class="py-5 border-top">
        <div class="container my-4 bg-footer">
            <h2 class="text-subtittle text-center">¿Cómo llegar?</h2>
            <div class="d-flex justify-content-center my-3">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3737.080217084175!2d-99.2247808!3d20.5029376!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d3e11d0b51c245%3A0x395025f8b89abbd7!2sCentro%20Ecoturistico%20La%20Heredad!5e0!3m2!1ses!2smx!4v1729574279279!5m2!1ses!2smx"
                    class="embed-responsive-item" style="width: 100%; max-width: 600px; height: 300px; border: 0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <h5 class="text-white text-center">Comunidad indígena La Heredad, municipio de Ixmiquilpan, Hgo.</h5>
            <ul class="nav flex-column align-items-center">
                <li class="nav-item mb-2 text-base">
                    <a href="https://www.facebook.com/EcoTuristicoLaHeredad/" class="nav-link p-0 text-white">
                        <i class="bi bi-facebook text-link"></i> Eco-Turístico La Heredad
                    </a>
                </li>
                <li class="nav-item mb-2 text-base">
                    <a href="#" class="nav-link p-0 text-white">Teléfono: 77 21 16 61 39</a>
                </li>
            </ul>
            <div class="d-flex justify-content-center">
                <ul class="nav flex-row">
                    <li class="nav-item mx-2">
                        <a href="{{ route('inicio') }}" class="nav-link p-0 text-white">Inicio</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="{{ route('servicios') }}" class="nav-link p-0 text-white">Servicios</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="{{ route('hospedaje') }}" class="nav-link p-0 text-white">Hospedaje</a>
                    </li>
                </ul>
            </div>
            <div class="text-center my-3">
                <img src="{{ asset('images/img2wp.png') }}" alt="Logo" style="max-width: 150px; height: auto;">
            </div>
        </div>
    </footer>
</div>
