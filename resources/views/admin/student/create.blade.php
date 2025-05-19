@extends('layouts.app')

@section('content')
    <h2>Registrar nuevo estudiante</h2>

    <form action="{{ route('student.store') }}" method="POST">
        @csrf

        <div>
            <label for="user_id">Usuario:</label>
            <select name="user_id" id="user_id" required>
                <option value="">Selecciona un usuario</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="address">Dirección:</label>
            <input type="text" name="address" id="address" required>
            <label for="phone">Teléfono:</label>
            <input type="text" name="phone" id="phone" required>
        </div>

        {{-- Agrega más campos si los hay --}}

        <button type="submit">Guardar</button>
    </form>
@endsection
