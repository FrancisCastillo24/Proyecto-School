<footer class="bg-dark text-white pt-4 mt-5">
    <!-- Navbar inferior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
        <div class="container justify-content-center justify-content-lg-between text-center text-lg-start">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#footerNavbar"
                aria-controls="footerNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center justify-content-lg-between" id="footerNavbar">
                <ul
                    class="navbar-nav flex-column flex-lg-row align-items-center w-100 justify-content-center justify-content-lg-start">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('course.index') }}">Cursos para
                            jovenes</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('event.index') }}">Eventos</a>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white"
                            href="{{ route('review.index') }}">Testimonios</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('blog.index') }}">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Información adicional -->
<div class="container mt-4">
    <div class="row text-center text-lg-start">
        <div class="col-12 col-lg-4 mb-3 d-flex flex-column align-items-center align-items-lg-start justify-content-center">
            <h5>Sobre la plataforma</h5>
            <p class="mb-0">Ofrecemos cursos y actividades educativas de calidad.</p>
            <p>Conocimientos accesibles para todos.</p>
        </div>
        <div class="col-12 col-lg-4 mb-3 d-flex flex-column align-items-center align-items-lg-start justify-content-center">
            <h5>Contacto</h5>
            <p class="mb-0">Email: elenarodriguezmena@gmail.com</p>
            <p class="mb-0">Teléfono: +34 656 75 43 89</p>
            <p>Dirección: Calle Santiago Apóstol, 23, Utrera</p>
        </div>
        <div class="col-12 col-lg-4 mb-3 d-flex flex-column align-items-center align-items-lg-start justify-content-center">
            <h5 class="fw-bold">Horario de Atención</h5>
            <p class="mb-0 text-secondary">Lunes a Jueves: 16:00h - 19:00h</p>
        </div>
    </div>
</div>

    <!-- Copyright -->
    <div class="text-center py-3 mt-3 border-top border-secondary">
        © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.
    </div>
</footer>
