@extends('layouts.appAdmin')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if ($usuariosSinEstudiante > 0)
            <div class="d-flex justify-content-center mb-3">
                <div class="alert alert-danger d-flex align-items-center justify-content-center fw-bold shadow rounded-circle"
                    style="width: 60px; height: 60px;" role="alert" title="Usuarios sin perfil de estudiante registrados"
                    aria-label="{{ $usuariosSinEstudiante }} usuarios sin perfil de estudiante registrados">
                    {{ $usuariosSinEstudiante }}
                </div>
            </div>
            <p class="text-center text-danger fw-semibold">
                Hay <strong>{{ $usuariosSinEstudiante }}</strong> usuario(s) registrados que aún no tienen un perfil de
                estudiante asociado. <br>
                Se recomienda completar su registro para evitar inconsistencias en el sistema.
            </p>
        @endif



        <!-- Tabla visible solo en lg+ -->
        <div class="table-responsive d-none d-lg-block">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Alumno</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->user->name }}</td>
                            <td>{{ $student->user->email }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>
                                <a href="{{ route('student.edit', $student->id) }}"
                                    class="btn btn-sm btn-outline-secondary me-1" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este estudiante?')">
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
                            <td colspan="6" class="text-muted">No hay estudiantes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Lista vertical visible solo en móviles -->
        <div class="d-lg-none">
            @forelse ($students as $student)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <p><strong>Código:</strong> {{ $student->id }}</p>
                        <p><strong>Alumno:</strong> {{ $student->user->name }}</p>
                        <p><strong>Email:</strong> {{ $student->user->email }}</p>
                        <p><strong>Dirección:</strong> {{ $student->address }}</p>
                        <p><strong>Teléfono:</strong> {{ $student->phone }}</p>
                        <div class="d-flex justify-content-end mt-2">
                            <a href="{{ route('student.edit', $student->id) }}"
                                class="btn btn-sm btn-outline-secondary me-2" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('student.destroy', $student->id) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar este estudiante?')">
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
                <p class="text-muted">No hay estudiantes registrados.</p>
            @endforelse
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('admin.student.create') }}" class="btn btn-outline-primary">
                Registrar nuevo usuario
            </a>
        </div>
    </div>
@endsection
