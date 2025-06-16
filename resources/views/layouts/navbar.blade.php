<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
  <div class="container-fluid">

    <!-- Botón hamburguesa -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú colapsable: TODO dentro -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">

      <!-- Menú principal -->
      <ul class="navbar-nav mx-auto mb-3 mb-lg-0 text-center flex-column flex-lg-row">
        <li class="nav-item my-1 mx-lg-2"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item my-1 mx-lg-2"><a class="nav-link" href="{{ route('course.index') }}">Cursos para jovenes</a></li>
        <li class="nav-item my-1 mx-lg-2"><a class="nav-link" href="{{ route('event.index') }}">Eventos</a></li>
        <li class="nav-item my-1 mx-lg-2"><a class="nav-link" href="{{ route('review.index') }}">Testimonios</a></li>
        <li class="nav-item my-1 mx-lg-2"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
      </ul>

      <!-- Bloque usuario -->
      <ul class="navbar-nav mx-auto mx-lg-0 flex-column flex-lg-row align-items-center text-center text-lg-start">
        @guest
          @if (Route::has('login'))
            <li class="nav-item my-1 mx-lg-2"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          @endif
          @if (Route::has('register'))
            <li class="nav-item my-1 mx-lg-2"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
          @endif
        @else
          <li class="nav-item dropdown my-1 mx-lg-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu dropdown-menu-center dropdown-menu-lg-end" aria-labelledby="navbarUserDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>

    </div>

  </div>
</nav>
