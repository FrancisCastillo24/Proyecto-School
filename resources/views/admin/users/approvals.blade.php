@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <h2>Usuarios pendientes de aprobación</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach ($users as $user)
        <div class="mb-3">
            <p>{{ $user->name }} - {{ $user->email }}</p>

            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Aprobar</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
