@extends('layouts.appAdmin')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-header bg-primary text-white text-center fs-4 fw-bold rounded-top-4">
                        Crear Nuevo Evento
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('event.store') }}" method="POST" novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">Nombre del Evento</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Ej: Festival de Música" required maxlength="50">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold">Descripción</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="4" placeholder="Describe el evento con detalle..." minlength="20" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="price" class="form-label fw-semibold">Precio ($)</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price') }}" min="0"
                                        step="0.01" placeholder="0.00" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="hours" class="form-label fw-semibold">Duración (Horas)</label>
                                    <input type="number" class="form-control @error('hours') is-invalid @enderror"
                                        id="hours" name="hours" value="{{ old('hours') }}" min="1"
                                        placeholder="Ej: 3" required>
                                    @error('hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="date" class="form-label fw-semibold">Fecha del Evento</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}"
                                    required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                                    Crear Evento
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
