<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('CSS/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('CSS/login.css') }}">
</head>
<body>
    <a href="{{ url('/') }}" class="btn-home">Inicio</a>

    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="username">Usuario</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
                </div>
                @error('username')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" name="password" required>
                </div>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit">Iniciar sesión</button>
            </div>

            @if ($errors->has('username'))
                <div class="alert alert-danger">
                    {{ $errors->first('username') }}
                </div>
            @endif
        </form>

        <div class="form-group">
            <a href="{{ route('register') }}" class="btn-register">Registrarse</a>
        </div>
    </div>
</body>
</html>
