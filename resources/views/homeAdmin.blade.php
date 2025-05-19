<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Estilos básicos con Flexbox --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 12px;
            padding: 8px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f4f6f8;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="">Dashboard</a>
        <a href="{{ route('admin.student.index') }}">Estudiantes</a>
        <a href="">Profesores</a>
        <a href="">Cursos</a>
        <a href=""
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
