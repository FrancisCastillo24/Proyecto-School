@extends('layouts.appAdmin')

@section('content')
<div class="container mt-4">
    <h2>Editar Transacción #{{ $transaction->id }}</h2>

    <form action="{{ route('admin.transaction.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuario Registrado (opcional)</label>
            <select name="user_id" id="user_id" class="form-select">
                <option value="">-- Selecciona usuario --</option>
                @foreach(App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ (old('user_id', $transaction->user_id) == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Si seleccionas un usuario registrado, no es necesario rellenar nombre y teléfono.</small>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nombre (solo para no registrados)</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $transaction->name) }}">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono (solo para no registrados)</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $transaction->phone) }}">
            @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Cantidad</label>
            <input type="number" name="quantity" id="quantity" min="1" class="form-control" value="{{ old('quantity', $transaction->quantity) }}" required>
            @error('quantity')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="price_per_entry" class="form-label">Precio por entrada (€)</label>
            <input type="number" step="0.01" name="price_per_entry" id="price_per_entry" min="0" class="form-control" value="{{ old('price_per_entry', $transaction->price_per_entry) }}" required>
            @error('price_per_entry')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <button class="btn btn-primary" type="submit">Actualizar</button>
        <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
