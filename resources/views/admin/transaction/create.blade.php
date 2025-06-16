@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <h1>Crear Transacción</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.transaction.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Alumno (registrado)</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Selecciona un alumno --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->student->phone ?? 'Sin teléfono' }})</option>
                @endforeach
            </select>
            @error('user_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="enrollment_fee" class="form-label">Precio matrícula</label>
            <input type="number" step="0.01" name="enrollment_fee" id="enrollment_fee" class="form-control" min="0" value="{{ old('enrollment_fee', 0) }}" required>
            @error('enrollment_fee')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price_per_entry" class="form-label">Precios aparte</label>
            <input type="number" step="0.01" name="price_per_entry" id="price_per_entry" class="form-control" required value="{{ old('price_per_entry', 0.00) }}">
            @error('price_per_entry')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar transacción</button>
    </form>
</div>
@endsection
