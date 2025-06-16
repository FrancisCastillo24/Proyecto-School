@extends('layouts.appAdmin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3 text-center fw-bold">Gestión de reservas</h1>

        <p class="text-muted text-center mb-4">
            Aquí puedes visualizar las personas de academia que han querido
            unirse al evento. Contacta con ellos para asegurarse de que no falten.
        </p>

        <div class="table-responsive">
            {{-- Tabla visible solo en md+ --}}
            <table class="table table-bordered table-striped shadow text-center d-none d-md-table">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Evento</th>
                        <th>Personas</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->event->name ?? 'Sin evento' }}</td>
                            <td>{{ $booking->quantity }}</td>
                            <td>{{ $booking->phone ?? 'Sin teléfono' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay reservas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Tarjetas visibles solo en sm/md --}}
            <div class="d-md-none">
                @forelse ($bookings as $booking)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <p><strong>Nombre:</strong> {{ $booking->name }}</p>
                            <p><strong>Evento:</strong> {{ $booking->event->name ?? 'Sin evento' }}</p>
                            <p><strong>Personas:</strong> {{ $booking->quantity }}</p>
                            <p><strong>Teléfono:</strong> {{ $booking->phone ?? 'Sin teléfono' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No hay reservas registradas.</p>
                @endforelse
            </div>
        </div>

        {{-- Controles de paginación --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
