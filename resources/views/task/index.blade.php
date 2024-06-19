<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/estilos.css') }}">
</head>
<body>
    <div class="barra-superior">
        <!-- Aquí se incluyen los botones de Login y Registro -->
        @if (Route::has('login'))
            <nav class="auth-links">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="btn"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="btn"
                    >
                        Acceder
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="btn"
                        >
                            Registrarse
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>
    <div class="contenido">
        <img src="{{ asset('CSS/sesesp.png') }}" alt="Logo" class="logo">
        <h1>Plataforma de video vigilancia C5i</h1>
        
        
    </div>
    <div class="barra-inferior"></div>
</body>
</html>
