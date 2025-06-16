@extends('layouts.app')

@section('content')

<!-- Hero principal -->
<div class="container-fluid bg-light text-dark text-center py-5">
    <h1 class="display-4 fw-bold">Bienvenido a la Academia Velázquez</h1>
    <p class="lead text-secondary">Impulsamos tu futuro académico con clases de calidad y profesores expertos.</p>
</div>


<!-- Sección de clases -->
<div class="container py-5">
    <h2 class="text-center mb-4">Nuestras Clases Destacadas</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm animate__animated animate__fadeInUp border-start border-5 border-primary">
                <div class="card-body">
                    <h5 class="card-title">Matemáticas Avanzadas</h5>
                    <p class="card-text">Álgebra, cálculo y estadística para potenciar tus habilidades matemáticas con expertos dedicados.</p>
                    <ul class="ps-3 text-muted small">
                        <li>Clases prácticas y teóricas</li>
                        <li>Material actualizado</li>
                        <li>Preparación para exámenes oficiales</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm animate__animated animate__fadeInUp animate__delay-1s border-start border-5 border-success">
                <div class="card-body">
                    <h5 class="card-title">Lengua y Literatura</h5>
                    <p class="card-text">Mejora tu expresión escrita, comprensión lectora y análisis literario para triunfar en tus estudios.</p>
                    <ul class="ps-3 text-muted small">
                        <li>Talleres de redacción</li>
                        <li>Estudio de obras clásicas y contemporáneas</li>
                        <li>Preparación para selectividad</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm animate__animated animate__fadeInUp animate__delay-2s border-start border-5 border-danger">
                <div class="card-body">
                    <h5 class="card-title">Inglés Académico</h5>
                    <p class="card-text">Curso intensivo para aprobar exámenes internacionales y mejorar tus habilidades comunicativas.</p>
                    <ul class="ps-3 text-muted small">
                        <li>Preparación Cambridge y IELTS</li>
                        <li>Clases de conversación y gramática</li>
                        <li>Simulacros de examen</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Eventos próximos -->
<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Próximos Eventos Académicos</h2>

        <article class="mx-auto mb-4 pb-3 border-bottom" style="max-width: 700px;">
            <header class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-dark">Jornada de Puertas Abiertas</h3>
                <time datetime="2025-05-25" class="fw-bold text-primary">15 de Septiembre, 2025</time>
            </header>
            <p class="mt-2 text-muted">Ven a conocer nuestras instalaciones, profesores y descubre todo lo que la Academia Velázquez puede ofrecerte. Trae a tus amigos y familiares para vivir una experiencia única.</p>
            <p class="fst-italic text-secondary mb-0">Lugar: Aula Magna, Planta Baja</p>
            <p class="fst-italic text-secondary mb-0">Hora: 10:00 a.m. - 2:00 p.m.</p>
        </article>

        <article class="mx-auto" style="max-width: 700px;">
            <header class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-dark">Simulacro de Selectividad</h3>
                <time datetime="2025-06-02" class="fw-bold text-success">2 de Junio, 2025</time>
            </header>
            <p class="mt-2 text-muted">Prepárate para la EBAU con un examen simulado realista, seguido de correcciones y tutorías personalizadas para mejorar tu rendimiento.</p>
            <p class="fst-italic text-secondary mb-0">Lugar: Aula 10, 1er piso</p>
            <p class="fst-italic text-secondary mb-0">Hora: 9:00 a.m. - 1:00 p.m.</p>
        </article>
    </div>
</div>

<!-- Testimonios -->
<div class="container py-5">
    <h2 class="text-center mb-4">Lo que dicen nuestros alumnos</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-4 animate__animated animate__fadeInLeft border-start border-4 border-primary">
                <blockquote class="blockquote mb-0">
                    <p class="text-dark fst-normal">"Gracias a la Academia Velázquez aprobé la EBAU con nota. ¡Los profesores me ayudaron muchísimo!"</p>
                    <footer class="blockquote-footer mt-3 text-secondary">Lucía Gómez, <cite title="Source Title">Estudiante de 2º Bachillerato</cite></footer>
                </blockquote>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-4 animate__animated animate__fadeInRight border-start border-4 border-success">
                <blockquote class="blockquote mb-0">
                    <p class="text-dark fst-normal">"El ambiente de estudio es excelente, y el seguimiento personalizado marca la diferencia."</p>
                    <footer class="blockquote-footer mt-3 text-secondary">Carlos Fernández, <cite title="Source Title">Alumno de ESO</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>

@endsection
