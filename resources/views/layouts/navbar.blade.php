<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
    <div class="container-fluid">

        <!-- Botón hamburguesa -->
        <div class="d-flex justify-content-center w-100 d-lg-none">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </div>

        <!-- Menú colapsable -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <!-- Menú principal centrado -->
            <ul
                class="navbar-nav w-100 d-flex flex-column align-items-center text-center mb-2 mb-lg-0 flex-lg-row justify-content-center">
                <li class="nav-item my-1 mx-lg-2"><a class="nav-link px-3" href="#">Home</a></li>
                <li class="nav-item my-1 mx-lg-2"><a class="nav-link px-3" href="#">Cursos para jovenes</a></li>
                <li class="nav-item my-1 mx-lg-2"><a class="nav-link px-3" href="#">Preparación de examenes</a></li>
                <li class="nav-item my-1 mx-lg-2"><a class="nav-link px-3" href="#">Testimonios</a></li>
                <li class="nav-item my-1 mx-lg-2"><a class="nav-link px-3" href="#">Blog</a></li>
            </ul>
            
            <!-- Usuario visible SOLO en móviles dentro del colapsable -->
            <ul class="navbar-nav d-lg-none mt-3 border-top pt-3">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endif
                @else
                    <li class="nav-item dropdown d-flex justify-content-center align-items-center flex-column">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu w-100 text-center">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>

        </div>

        <!-- Usuario visible SOLO en pantallas grandes, alineado a la derecha -->
        <div class="d-none d-lg-flex align-items-center ms-auto">
            <ul class="navbar-nav mb-0">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>
