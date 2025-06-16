@extends('layouts.appAdmin')

@section('content')
<div class="container py-5">
    <h1 class="mb-3 text-center fw-bold">Gestión de Eventos</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <p class="text-muted text-center mb-4">
        Aquí puedes gestionar todos los eventos registrados. Asegúrate de revisar y mantener actualizada la información de cada evento para una experiencia óptima de los usuarios.
    </p>

    {{-- Tabla para md en adelante --}}
    <div class="d-none d-md-block table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>📌 Nombre</th>
                    <th>📝 Descripción</th>
                    <th>💰 Precio</th>
                    <th>⏳ Horas</th>
                    <th>📅 Fecha</th>
                    <th>⚙️ Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td class="fw-semibold text-truncate" style="max-width: 120px;">{{ $event->name }}</td>
                        <td class="text-truncate" style="max-width: 200px;">{{ Str::limit($event->description, 50) }}</td>
                        <td>${{ number_format($event->price, 2) }}</td>
                        <td>{{ $event->hours }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('event.edit', $event->id) }}" 
                               class="btn btn-sm btn-outline-warning me-1" 
                               title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('event.destroy', $event->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este evento?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay eventos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Lista para móvil (xs y sm) --}}
    <div class="d-md-none">
        @forelse($events as $event)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">{{ $event->name }}</h5>
                    <p class="card-text text-truncate">{{ Str::limit($event->description, 100) }}</p>
                    <p class="mb-1"><strong>Precio:</strong> ${{ number_format($event->price, 2) }}</p>
                    <p class="mb-1"><strong>Horas:</strong> {{ $event->hours }}</p>
                    <p class="mb-2"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                    <div>
                        <a href="{{ route('event.edit', $event->id) }}" 
                           class="btn btn-sm btn-outline-warning me-1" 
                           title="Editar">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('event.destroy', $event->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('¿Estás seguro de eliminar este evento?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                <i class="bi bi-trash3-fill"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No hay eventos disponibles.</p>
        @endforelse
    </div>

    <div class="text-end mt-4">
        <a href="{{ route('event.create') }}" class="btn btn-success btn-lg shadow">
            <i class="bi bi-plus-circle-fill me-2"></i> Nuevo Evento
        </a>
    </div>
</div>
@endsection
