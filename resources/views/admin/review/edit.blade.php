@extends('layouts.appAdmin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Editar Testimonio</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups...</strong> Hubo algunos problemas con tus datos:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('review.update', $review->id) }}" method="POST" class="card shadow p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="opinion" class="form-label">Opinión</label>
            <textarea class="form-control" id="opinion" name="opinion" rows="4" required>{{ old('opinion', $review->opinion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Valoración (1 a 5)</label>
            <select class="form-select" id="rating" name="rating" required>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>
                        {{ $i }} estrella{{ $i > 1 ? 's' : '' }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="text-end">
            <a href="{{ route('review.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>
@endsection
