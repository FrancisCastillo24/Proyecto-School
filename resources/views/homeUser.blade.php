@extends('layouts.app')

@section('content')

<!-- Hero principal -->
<div class="container-fluid" style="background-color: #2c3e50; color: #ecf0f1; text-align: center; padding: 3rem 1rem;">
    <h1 class="display-4 fw-bold" style="font-weight: 700;">Bienvenido a la Academia Velázquez</h1>
    <p class="lead" style="color: #bdc3c7;">Impulsamos tu futuro académico con clases de calidad y profesores expertos.</p>
</div>


<!-- Sección de clases -->
<div class="container py-5">
    <h2 class="text-center mb-4">Nuestras Clases Destacadas</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm animate__animated animate__fadeInUp">
                <div class="card-body">
                    <h5 class="card-title">Matemáticas Avanzadas</h5>
                    <p class="card-text">Refuerza tus conocimientos en álgebra, cálculo y estadística con docentes especializados.</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
                    <a href="#" class="btn btn-outline-primary btn-sm">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm animate__animated animate__fadeInUp animate__delay-1s">
                <div class="card-body">
                    <h5 class="card-title">Lengua y Literatura</h5>
                    <p class="card-text">Mejora tu redacción, comprensión lectora y preparación para exámenes oficiales.</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
                    <a href="#" class="btn btn-outline-primary btn-sm">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm animate__animated animate__fadeInUp animate__delay-2s">
                <div class="card-body">
                    <h5 class="card-title">Inglés Académico</h5>
                    <p class="card-text">Prepara los exámenes oficiales de Cambridge y mejora tu fluidez oral y escrita.</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
                    <a href="#" class="btn btn-outline-primary btn-sm">Ver más</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Eventos próximos -->
<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Eventos Académicos</h2>
        <div class="list-group">
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Jornada de Puertas Abiertas</h5>
                    <p class="mb-0">Conoce nuestras instalaciones y profesores. ¡Invita a tus amigos!</p>
                </div>
                <span class="badge bg-primary rounded-pill">25 May</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Simulacro de Selectividad</h5>
                    <p class="mb-0">Prepárate como si fuera el examen real, con correcciones personalizadas.</p>
                </div>
                <span class="badge bg-primary rounded-pill">2 Jun</span>
            </div>
        </div>
    </div>
</div>

<!-- Testimonios -->
<div class="container py-5">
    <h2 class="text-center mb-4">Lo que dicen nuestros alumnos</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-3 animate__animated animate__fadeInLeft">
                <blockquote class="blockquote mb-0">
                    <p>Gracias a la Academia Velázquez aprobé la EBAU con nota. ¡Los profesores me ayudaron muchísimo!</p>
                    <footer class="blockquote-footer mt-2">Lucía Gómez, <cite title="Source Title">Estudiante de 2º Bachillerato</cite></footer>
                </blockquote>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-3 animate__animated animate__fadeInRight">
                <blockquote class="blockquote mb-0">
                    <p>El ambiente de estudio es excelente, y el seguimiento personalizado marca la diferencia.</p>
                    <footer class="blockquote-footer mt-2">Carlos Fernández, <cite title="Source Title">Alumno de ESO</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>

@endsection
