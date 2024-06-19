<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('CSS/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <a href="{{ url('/') }}" class="btn-home">Inicio</a>
    
    <div class="login-container">
        <h2>Registro</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nombre</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                </div>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Usuario</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required>
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
                <label for="password-confirm">Confirmar Contraseña</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input id="password-confirm" type="password" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit">Registrarse</button>
            </div>
        </form>
        <div class="already-registered">
            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="btn-login">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>
