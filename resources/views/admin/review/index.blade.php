@extends('layouts.appAdmin')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4 text-center">Gestión de Testimonios</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <p class="text-muted text-center mb-4">
            Aquí puedes revisar, modificar o eliminar los testimonios que han dejado los usuarios en el sistema.
            Asegúrate de mantener la calidad y veracidad de las opiniones publicadas.
        </p>

        <!-- Tabla visible solo en lg+ -->
        <div class="table-responsive d-none d-lg-block">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Opinión</th>
                        <th>Valoración</th>
                        <th>Fecha creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td class="text-truncate" style="max-width: 300px;" title="{{ $review->opinion }}">
                                {{ $review->opinion }}</td>
                            <td>
                                <span class="badge bg-warning text-dark" title="Calificación">
                                    {{ $review->rating }}/5
                                </span>
                            </td>
                            <td>{{ $review->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('review.edit', $review->id) }}"
                                    class="btn btn-sm btn-outline-secondary me-1" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este testimonio? Esta acción es irreversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No hay testimonios registrados en el sistema.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Lista vertical visible solo en móviles -->
        <div class="d-lg-none">
            @forelse ($reviews as $review)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $review->title }}</h5>
                        <p class="card-text text-truncate" style="max-height: 4.5em;" title="{{ $review->content }}">
                            {{ Str::limit($review->content, 100) }}
                        </p>
                        <p>
                            <span class="badge bg-warning text-dark">{{ $review->rating }}/5</span>
                            <small class="text-muted ms-3">Creado: {{ $review->created_at->format('d/m/Y') }}</small>
                        </p>
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('review.edit', $review->id) }}" class="btn btn-sm btn-outline-secondary me-2"
                                title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('review.destroy', $review->id) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar este testimonio? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">No hay testimonios registrados en el sistema.</p>
            @endforelse
        </div>
    </div>
@endsection
