@extends('layouts.appAdmin')

@section('content')
<div class="container mt-4">
    <h2>Detalle de Transacción #{{ $transaction->id }}</h2>

    <table class="table table-bordered w-50">
        <tr>
            <th>Usuario Registrado</th>
            <td>{{ $transaction->user ? $transaction->user->name : '-' }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $transaction->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Teléfono</th>
            <td>{{ $transaction->phone ?? '-' }}</td>
        </tr>
        <tr>
            <th>Cantidad</th>
            <td>{{ $transaction->quantity }}</td>
        </tr>
        <tr>
            <th>Precio por entrada (€)</th>
            <td>{{ number_format($transaction->price_per_entry, 2) }}</td>
        </tr>
        <tr>
            <th>Precio total (€)</th>
            <td>{{ number_format($transaction->total_price, 2) }}</td>
        </tr>
        <tr>
            <th>Creado en</th>
            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
