@extends('layouts.appAdmin')

@section('content')
    <div class="container bg-white shadow rounded p-4 w-100" style="max-width: 600px;">
        <h2 class="mb-4 text-primary">Editar Estudiante</h2>

        <form action="{{ route('admin.student.update', $student->id) }}" method="POST" id="studentEditForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">Usuario</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">Selecciona un usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $student->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

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
