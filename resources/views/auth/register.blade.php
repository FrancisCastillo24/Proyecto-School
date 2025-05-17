<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Academia Velázquez</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #f3f4f6, #dbeafe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-glass {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
        }

        .register-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e3a8a;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #1e40af;
            border-color: #1e40af;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="register-glass">
                <div class="register-title">Registro en Academia Velázquez</div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            name="password" required>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                        <input id="password-confirm" type="password" 
                            class="form-control" 
                            name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Registrarse
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
