@extends('layouts.app')

@section('content')
<!-- HERO -->
<div class="bg-dark text-white text-center py-5" style="background: url('https://source.unsplash.com/1600x400/?education') center/cover;">
  <div class="container">
    <h1 class="display-4 fw-bold">Bienvenido a la Academia Saber+</h1>
    <p class="lead">Formación de calidad para transformar tu futuro.</p>
    <a href="#registro" class="btn btn-primary btn-lg mt-3">Únete ahora</a>
  </div>
</div>

<!-- VENTAJAS -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="mb-4 text-center">¿Por qué elegirnos?</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Profesores Expertos</h5>
            <p class="card-text">Contamos con docentes altamente calificados con años de experiencia.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Plataforma Interactiva</h5>
            <p class="card-text">Accede a clases en vivo, foros, tareas y seguimiento personalizado.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Certificaciones Oficiales</h5>
            <p class="card-text">Obtén certificados reconocidos en todo el país al finalizar tus cursos.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- BLOG DE CURSOS / NOVEDADES -->
<section class="py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Últimas novedades</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100">
          <img src="https://source.unsplash.com/400x250/?classroom" class="card-img-top" alt="Curso">
          <div class="card-body">
            <h5 class="card-title">Inglés B2 intensivo</h5>
            <p class="card-text">Prepárate para obtener tu certificación en tiempo récord. ¡Comienza en julio!</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="https://source.unsplash.com/400x250/?books,student" class="card-img-top" alt="Curso">
          <div class="card-body">
            <h5 class="card-title">Curso de matemáticas para ESO</h5>
            <p class="card-text">Refuerza tus conocimientos con nuestro programa diseñado para adolescentes.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="https://source.unsplash.com/400x250/?online-learning" class="card-img-top" alt="Curso">
          <div class="card-body">
            <h5 class="card-title">Nueva Aula Virtual</h5>
            <p class="card-text">Ahora puedes acceder a todos los contenidos desde cualquier dispositivo.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FORMULARIO DE REGISTRO -->
<section id="registro" class="py-5 bg-light">
  <div class="container">
    <h2 class="mb-4 text-center">¿Quieres ser parte de la academia?</h2>
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <p class="mb-4">Completa este formulario y te llevaremos al proceso de registro para convertirte en estudiante.</p>
              <button type="submit" class="btn btn-primary w-100">Registrarme como alumno</button>
            </form>
            <small class="d-block text-muted mt-3 text-center">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>.</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
