<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Academia Velázquez</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="min-vh-100 d-flex justify-content-center align-items-center"
    style="background: linear-gradient(135deg, #e9f0fb, #ffffff);">
    <div class="card bg-white bg-opacity-75 shadow-lg rounded-4 p-4"
        style="max-width: 600px; width: 90%; margin: 0 15px;">

        <h2 class="text-center text-primary mb-4 fw-bold">Bienvenido a Academia Velázquez</h2>

        <div class="container">
            @if (session('success'))
                <div class="d-flex justify-content-center">
                    <div class="alert alert-info px-4 py-2" style="max-width: fit-content;">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="d-flex justify-content-center">
                    <div class="alert alert-danger px-4 py-2" style="max-width: fit-content;">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>


        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold">Entrar</button>

            <div class="mt-3 text-center">
                <p>¿No tienes cuenta? <a href="{{ route('register') }}"
                        class="link-primary text-decoration-none">Regístrate aquí</a></p>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="d-block link-secondary small">¿Olvidaste tu
                        contraseña?</a>
                @endif
            </div>
        </form>
    </div>
</body>

</html>
