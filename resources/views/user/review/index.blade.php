@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h2 class="mb-4">Reseñas de alumnos</h2>

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning text-center">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Alumno</th>
                        <th scope="col">Opinión</th>
                        <th scope="col">Valoración</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->opinion }}</td>
                            <td>
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <span class="text-warning">&#9733;</span>
                                @endfor
                                @for ($i = $review->rating; $i < 5; $i++)
                                    <span class="text-muted">&#9734;</span>
                                @endfor
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay reseñas actualmente</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('review.create') }}" class="btn btn-primary mt-3">
            <i class="bi bi-plus-circle me-1"></i> Añadir reseña
        </a>
    </div>
@endsection
