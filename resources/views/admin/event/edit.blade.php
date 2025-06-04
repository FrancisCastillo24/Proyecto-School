@extends('layouts.appAdmin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Editar Evento</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('event.update', $event->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nombre del Evento</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $event->name) }}" 
                                   maxlength="50" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Descripción</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" minlength="20" required>{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Precio ($)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $event->price) }}" 
                                   step="0.01" min="0" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Horas -->
                        <div class="mb-3">
                            <label for="hours" class="form-label fw-semibold">Horas</label>
                            <input type="number" class="form-control @error('hours') is-invalid @enderror" 
                                   id="hours" name="hours" value="{{ old('hours', $event->hours) }}" 
                                   min="1" required>
                            @error('hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fecha -->
                        <div class="mb-4">
                            <label for="date" class="form-label fw-semibold">Fecha</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                   id="date" name="date" value="{{ old('date', $event->date->format('Y-m-d')) }}" 
                                   min="{{ date('Y-m-d') }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('event.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-4">Actualizar Evento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
