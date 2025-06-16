@extends('layouts.appAdmin')

@section('content')
<div class="container mt-4">
    <h2>Editar Transacción #{{ $transaction->id }}</h2>

    <form action="{{ route('admin.transaction.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Alumno (registrado)</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Selecciona usuario --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $transaction->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="enrollment_fee" class="form-label">Precio matrícula (€)</label>
            <input type="number" step="0.01" name="enrollment_fee" id="enrollment_fee" min="0" class="form-control" value="{{ old('enrollment_fee', $transaction->enrollment_fee) }}" required>
            @error('enrollment_fee')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price_per_entry" class="form-label">Precios aparte (€)</label>
            <input type="number" step="0.01" name="price_per_entry" id="price_per_entry" min="0" class="form-control" value="{{ old('price_per_entry', $transaction->price_per_entry) }}" required>
            @error('price_per_entry')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Actualizar</button>
        <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
