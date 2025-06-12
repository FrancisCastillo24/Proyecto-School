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
            <label for="user_id" class="form-label">Alumno</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Selecciona un alumno --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->phone }})</option>
                @endforeach
            </select>
            @error('user_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price_per_entry" class="form-label">Precio por evento</label>
            <input type="number" step="0.01" name="price_per_entry" class="form-control" required>
            @error('price_per_entry')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar transacción</button>
    </form>
</div>
@endsection
