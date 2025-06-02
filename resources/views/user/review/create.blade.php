@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Añadir Reseña</h2>

        <form action="{{ route('review.store') }}" method="POST" novalidate>
            @csrf

            <div class="mb-4">
                <label for="opinion" class="form-label fw-semibold">Tu Opinión</label>
                <textarea class="form-control @error('opinion') is-invalid @enderror" id="opinion" name="opinion" rows="5"
                    placeholder="Escribe aquí tu opinión sobre el curso, profesor o academia...">{{ old('opinion') }}</textarea>
                @error('opinion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="rating" class="form-label fw-semibold">Valoración</label>
                <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                    <option value="" disabled selected>Selecciona una valoración</option>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 &#9733;</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 &#9733;</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 &#9733;</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 &#9733;</option>
                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 &#9733;</option>
                </select>


                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('review.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i> Volver
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i> Enviar Reseña
                </button>
            </div>
        </form>
    </div>
@endsection
