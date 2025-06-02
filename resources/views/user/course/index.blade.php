@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm" style="background-color: #e6e0f8;"> <!-- gris muy claro -->
        <div class="card-body">
            <h2 class="card-title mb-4">Cursos Disponibles</h2>
            <button id="btnMostrarCursos" class="btn btn-primary mb-3">Mostrar Cursos</button>
            <div id="contenedorTabla"></div>
        </div>
    </div>
</div>


    <div class="my-5"></div> <!-- espacio vertical vacío -->

    {{-- Imagen full width igual que navbar --}}
    <div class="container-fluid p-0 mb-4">
        <img src="{{ asset('storage/img4.jpg') }}" alt="Banner conocimiento"
            style="width: 100%; height: auto; display: block; object-fit: cover;">
    </div>



    <div class="container mt-5">
        <h3 class="mb-4 text-center fw-bold text-dark"
            style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; letter-spacing: 0.05em; font-weight: 700;">
            Explora el Conocimiento
        </h3>


        <div class="row row-cols-1 row-cols-md-3 g-4">

            <div class="col">
                <div class="card h-100 border-0 shadow-lg rounded-4">
                    <img src="{{ asset('storage/img1.jpg') }}" class="card-img-top rounded-top-4" alt="Aprender es crecer">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Aprender es crecer</h5>
                        <p class="card-text text-muted">
                            Duración: 6 semanas<br>
                            Nivel: Principiante<br>
                            Modalidad: Online<br>
                            Cada día es una oportunidad para descubrir, cuestionar y avanzar en tu aprendizaje.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-lg rounded-4">
                    <img src="{{ asset('storage/img2.jpg') }}" class="card-img-top rounded-top-4"
                        alt="La educación transforma">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">La educación transforma</h5>
                        <p class="card-text text-muted">
                            Duración: 8 semanas<br>
                            Nivel: Intermedio<br>
                            Modalidad: Presencial<br>
                            Un buen curso puede cambiar para siempre tu perspectiva y forma de entender el mundo.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-lg rounded-4">
                    <img src="{{ asset('storage/img3.jpg') }}" class="card-img-top rounded-top-4"
                        alt="Tecnología y conocimiento">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Tecnología y conocimiento</h5>
                        <p class="card-text text-muted">
                            Duración: 10 semanas<br>
                            Nivel: Avanzado<br>
                            Modalidad: Mixto<br>
                            La innovación comienza con curiosidad y formación continua para estar a la vanguardia.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    @endsection



    @section('scripts')
        @vite('resources/js/cursos/curso.js')
    @endsection
