@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Lista de Eventos</h2>

        <div class="table-responsive mb-4">
            <table class="table table-hover table-bordered align-middle shadow text-center">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nombre</th>
                        <th>Detalle</th>
                        <th>Precio</th>
                        <th>Horas</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($events->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No hay eventos disponibles.</td>
                        </tr>
                    @else
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ number_format($event->price, 2) }}€</td>
                                <td>{{ $event->hours }}</td>
                                <td>{{ $event->date }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <a href="{{ route('booking.create') }}" id="btnNewBooking" class="btn btn-secondary btn-sm mb-4">
            Reservar
        </a>

        <div class="row">
            <!-- Columna izquierda: formulario -->
            <div class="col-md-6" id="bookingFormContainer">
                {{-- Aquí se cargará el formulario --}}
            </div>

            <!-- Columna derecha: info profesional y clara -->
            <div class="col-md-6">
                <div class="p-4 border rounded shadow-sm bg-light">
                    <h5 class="mb-3">Información sobre precios</h5>
                    <p class="mb-2">
                        <strong>Precio por persona:</strong> El precio indicado corresponde a una persona.
                    </p>
                    <p class="mb-2">
                        Al reservar para varias personas, el precio total será el resultado de multiplicar el precio
                        individual por la cantidad seleccionada.
                    </p>
                    <p class="mb-0 text-muted fst-italic" style="font-size: 0.9rem;">
                        Ejemplo: Si el precio es 10€, y reservas para 3 personas, el total será 30€.
                    </p><br>
                    <p class="mb-2">
                        Si tienen alguna duda, consulta sobre tus reservas o quieren realizarlas de manera más cómodo, contacten al 758525252
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
