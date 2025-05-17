<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Bienvenido</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light d-flex align-items-center vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4 text-center">Iniciar sesión</h3>

                    {{-- Mostrar errores --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Mostrar mensaje de éxito --}}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required />
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                            <label class="form-check-label" for="remember">Recordarme</label>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Entrar</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a><br/>
                        <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
