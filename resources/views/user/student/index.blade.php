@extends('layouts.app')

@section('content')
    <table style="border: 3px solid black; width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Código</th>
                <th>Alumno</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->phone }}</td> {{-- Asumiendo que es 'phone' --}}
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay estudiantes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.student.create') }}">Registrar nuevo usuario</a>
@endsection
