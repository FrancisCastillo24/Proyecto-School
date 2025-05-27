@extends('layouts.appAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Registrar nuevo estudiante</h2>

    <form action="{{ route('student.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm" id="studentForm">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Seleccionar usuario existente (opcional)</label>
            <select name="user_id" id="user_id" class="form-select">
                <option value="">-- Ninguno --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Si no seleccionas usuario, debes crear uno nuevo abajo.</small>
        </div>

        <hr>

        <div id="newUserFields" style="display: none;">
            <h5>Crear un usuario nuevo:</h5>

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de Usuario</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <hr>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<script>
    const userSelect = document.getElementById('user_id');
    const newUserFields = document.getElementById('newUserFields');

    function toggleNewUserFields() {
        if (userSelect.value) {
            newUserFields.style.display = 'none';
            // Opcional: limpiar campos
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        } else {
            newUserFields.style.display = 'block';
        }
    }

    userSelect.addEventListener('change', toggleNewUserFields);

    // Ejecutar al cargar la página para respetar old()
    window.onload = toggleNewUserFields;
</script>
@endsection
