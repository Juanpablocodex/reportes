<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Reporte</title>
    <link rel="stylesheet" href="{{ asset('CSS/form.css') }}">
</head>
<body>
    <div class="form-container">
        <header>
            <h1>Reporte</h1>
            <img src="{{ asset('CSS/sesesp.png') }}" alt="Logo" class="logo">
        </header>
        <form action="{{ route('reportes.store') }}" method="POST">
            @csrf
            <fieldset>
                <legend>INFORMACIÓN BÁSICA</legend>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ $nombreUsuario }}" readonly>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="{{ $fechaActual }}" readonly>
            </fieldset>
            <fieldset>
                <legend>INFORMACIÓN DEL DISPOSITIVO</legend>
                <label for="nombre_camara">Nombre de la cámara</label>
                <input type="text" id="nombre_camara" name="nombre_camara">
            </fieldset>
            <fieldset>
                <legend>INFORMACIÓN ADICIONAL</legend>
                <label for="incidente">Incidente</label>
                <input type="text" id="incidente" name="incidente">
                <label for="descripcion">Descripción del problema</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </fieldset>
            <div class="button-group">
                <button type="submit" class="guardar-button">Guardar</button>
                <a href="{{ route('dashboard', ['section' => 'reports']) }}" class="cancelar-button">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
