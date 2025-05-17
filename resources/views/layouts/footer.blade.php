<footer class="bg-dark text-white pt-4 mt-5">
    <!-- Navbar inferior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
        <div class="container justify-content-center justify-content-lg-between text-center text-lg-start">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#footerNavbar" aria-controls="footerNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center justify-content-lg-between" id="footerNavbar">
                <ul class="navbar-nav flex-column flex-lg-row align-items-center w-100 justify-content-center justify-content-lg-start">
                    <li class="nav-item"><a class="nav-link text-white" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Blog</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Información adicional -->
    <div class="container mt-4">
        <div class="row text-center text-lg-start">
            <div class="col-12 col-lg-6 mb-3 d-flex flex-column align-items-center align-items-lg-start justify-content-center">
                <h5>Sobre la plataforma</h5>
                <p class="mb-0">Ofrecemos cursos y actividades educativas de calidad.</p>
                <p>Conocimientos accesibles para todos.</p>
            </div>
            <div class="col-12 col-lg-6 mb-3 d-flex flex-column align-items-center align-items-lg-start justify-content-center">
                <h5>Contacto</h5>
                <p class="mb-0">Email: contacto@ejemplo.com</p>
                <p class="mb-0">Teléfono: +34 600 123 456</p>
                <p>Dirección: Calle Ficticia 123, Madrid</p>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center py-3 mt-3 border-top border-secondary">
        © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.
    </div>
</footer>
