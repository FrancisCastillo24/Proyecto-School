  <!-- Navbar lateral / superior -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark flex-lg-column p-3">
      <div class="container-fluid flex-lg-column p-0">

          <!-- Botón hamburguesa centrado en móvil -->
          <button class="navbar-toggler mx-auto mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#adminMenu"
              aria-controls="adminMenu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Marca / título centrado en móvil -->
          <a class="navbar-brand mx-auto mb-3 mb-lg-4" href="{{ route('homeAdmin') }}">Panel</a>

          <!-- Menú colapsable -->
          <div class="collapse navbar-collapse flex-lg-column text-center text-lg-start" id="adminMenu">
              <ul class="navbar-nav flex-column w-100">
                  <li class="nav-item">
                      <a class="nav-link active" href="{{ route('homeAdmin') }}"><i
                              class="bi bi-house-door-fill me-2"></i>Inicio</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.student.index') }}"><i
                              class="bi bi-info-circle me-2"></i>Estudiantes</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.users.pending') }}">
                          <i class="bi bi-gear-fill me-2"></i>Aprobar usuario
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.review.index') }}">
                          <i class="bi bi-chat-left-quote-fill me-2"></i> Testimonios
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.event.index') }}">
                          <i class="bi bi-calendar-event me-2"></i> Eventos
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.booking.index') }}">
                          <i class="bi-journal-text"></i> Booking
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="bi bi-box-arrow-right me-2"></i>Salir
                      </a>
                  </li>
              </ul>
          </div>

      </div>
  </nav>
