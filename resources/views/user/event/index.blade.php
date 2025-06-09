@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div id="mensaje" style="color: green; margin-top: 10px;"></div>
        <h2 class="mb-4">Lista de Eventos</h2>
        <div class="table-responsive">
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

        <a href="{{ route('booking.create') }}" id="btnNewBooking" class="btn btn-secondary btn-sm">
            Reservar
        </a>

        <div id="bookingFormContainer" class="mt-3"></div>


    </div>


    </div>
@endsection
