@extends('layouts.appAdmin')

@section('content')
    <div class="container mt-4">
    <h1 class="mb-3 text-center fw-bold">Gestión de Eventos</h1>

        <p class="text-muted text-center mb-4">
            Aquí puedes visualizar las personas tanto ajenas a la academia como tus propios estudiantes, que han querido unirse al evento. Contacta con ellos para asegurarse de que no falten.
        </p>

        <div class="table-responsive">
            <table class="table table-bordered table-striped shadow text-center">
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
                            <td>{{ $booking->phone }}</td>
                            <td>{{ $booking->quantity }}</td>
                            <td>{{ $booking->event->name ?? 'Sin evento' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay reservas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Controles de paginación --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
