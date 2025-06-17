@extends('layouts.appAdmin')

@section('content')
    <div class="container bg-white shadow rounded p-4 w-100" style="max-width: 600px;">
        <h2 class="mb-4 text-primary">Editar Estudiante</h2>

        <form action="{{ route('admin.student.update', $student->id) }}" method="POST" id="studentEditForm">
            @csrf
            @method('PUT')

            <hr>

            <input type="hidden" name="user_id" value="{{ $student->user_id }}">

            <div class="mb-3">
                <label for="name" class="form-label">Nombre (opcional)</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name', $student->user->name) }}" placeholder="Editar nombre (no obligatorio)">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email (opcional)</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="{{ old('email', $student->user->email) }}" placeholder="Editar email (no obligatorio)">
            </div>

            <hr>

            <div class="mb-3">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" name="address" id="address" class="form-control"
                       value="{{ old('address', $student->address) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" name="phone" id="phone" class="form-control"
                       value="{{ old('phone', $student->phone) }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.student.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
