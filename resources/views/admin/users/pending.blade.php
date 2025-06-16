@extends('layouts.appAdmin')

@section('content')
    <div class="container my-5" style="max-width: 700px;">
        <h2 class="mb-4 text-muted text-center fw-bold border-bottom border-primary pb-2 text-uppercase"
            style="letter-spacing: 2px;">
            Usuarios pendientes de aprobación
        </h2>

        @if (session('success'))
            <div class="alert alert-success border border-success shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($users as $user)
            <div
                class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded border border-primary shadow-sm flex-wrap">
                <div class="text-dark fw-semibold mb-2 mb-md-0">
                    <strong>{{ $user->name }}</strong> — <small class="text-muted">{{ $user->email }}</small>
                </div>

                <div class="d-flex gap-2">
                    <!-- Botón Aprobar -->
                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm fw-semibold text-uppercase shadow-sm"
                            style="letter-spacing: 1.2px;">
                            Aprobar
                        </button>
                    </form>

                    <!-- Botón Eliminar -->
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="m-0 ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm fw-semibold text-uppercase shadow-sm"
                            style="letter-spacing: 1.2px;">
                            Eliminar
                        </button>
                    </form>

                </div>
            </div>
        @empty
            <p class="text-secondary fst-italic">No hay usuarios pendientes de aprobación.</p>
        @endforelse


        <div class="mt-4 d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
