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
                    <form id="eventForm" action="{{ route('event.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Nombre del Evento</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ej: Festival de Música" maxlength="50" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe el evento con detalle..." minlength="20" required></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-semibold">Precio ($)</label>
                                <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" placeholder="0.00" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="hours" class="form-label fw-semibold">Duración (Horas)</label>
                                <input type="number" class="form-control" id="hours" name="hours" min="1" placeholder="Ej: 3" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="date" class="form-label fw-semibold">Fecha del Evento</label>
                            <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}" required>
                            <div class="invalid-feedback"></div>
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
