@extends('layouts.appAdmin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Listado de Transacciones</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.transaction.create') }}" class="btn btn-success mb-3">Nueva Transacción</a>

        {{-- Tabla visible solo en md+ --}}
        <div class="table-responsive d-none d-md-block">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Alumno</th>
                        <th>Teléfono</th>
                        <th>Precio matrícula (€)</th>
                        <th>Precio total (€)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user?->name ?? 'Sin nombre' }}</td>
                            <td>{{ $transaction->user?->student?->phone ?? 'Sin teléfono' }}</td>
                            <td>{{ number_format($transaction->enrollment_fee) }} €</td>
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
        </div>

        {{-- Tarjetas para móviles y tablets --}}
        <div class="d-md-none">
            @foreach ($transactions as $transaction)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $transaction->id }}</p>
                        <p><strong>Alumno:</strong> {{ $transaction->user?->name ?? 'Sin nombre' }}</p>
                        <p><strong>Teléfono:</strong> {{ $transaction->user?->student?->phone ?? 'Sin teléfono' }}</p>
                        <p><strong>Precio matrícula (€):</strong> {{ number_format($transaction->enrollment_fee) }} €</p>
                        <p><strong>Precio total (€):</strong> {{ number_format($transaction->total_price, 2) }} €</p>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.transaction.edit', $transaction) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.transaction.destroy', $transaction) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta transacción?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
