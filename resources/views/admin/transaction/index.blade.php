@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <h1>Listado de Transacciones</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.transaction.create') }}" class="btn btn-success mb-3">Nueva Transacción</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Alumno</th>
                <th>Teléfono</th>
                <th>Eventos</th>
                <th>Precio por evento</th>
                <th>Precio total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->user?->name ?? 'Sin usuario' }}</td>
                    <td>{{ $transaction->user?->student?->phone ?? 'No tiene teléfono' }}</td>
                    <td>
                        {{ $transaction->user?->events->count() ?? 0 }} <br>
                        @foreach($transaction->user?->events ?? [] as $event)
                            - {{ $event->name }}<br>
                        @endforeach
                    </td>
                    <td>{{ number_format($transaction->price_per_entry, 2) }} €</td>
                    <td>{{ number_format($transaction->total_price, 2) }} €</td>
                    <td>
                        <a href="{{ route('admin.transaction.edit', $transaction) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.transaction.destroy', $transaction) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta transacción?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transactions->links() }}
</div>
@endsection
