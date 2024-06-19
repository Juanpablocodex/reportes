<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reporte</title>
    <link rel="stylesheet" href="{{ asset('CSS/form.css') }}">
</head>
<body>
    <div class="form-container">
        <header>
            <h1>Editar Reporte</h1>
            <img src="{{ asset('CSS/sesesp.png') }}" alt="Logo" class="logo">
        </header>
        <form action="{{ route('reportes.update', $reporte->id) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset>
                <legend>INFORMACIÓN BÁSICA</legend>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ $reporte->nombre }}" readonly>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="{{ $reporte->fecha }}" readonly>
            </fieldset>
            <fieldset>
                <legend>INFORMACIÓN DEL DISPOSITIVO</legend>
                <label for="nombre_camara">Nombre de la cámara</label>
                <input type="text" id="nombre_camara" name="nombre_camara" value="{{ $reporte->nombre_camara }}">
            </fieldset>
            <fieldset>
                <legend>INFORMACIÓN ADICIONAL</legend>
                <label for="incidente">Incidente</label>
                <input type="text" id="incidente" name="incidente" value="{{ $reporte->incidente }}">
                <label for="descripcion">Descripción del problema</label>
                <textarea id="descripcion" name="descripcion">{{ $reporte->descripcion }}</textarea>
            </fieldset>
            <div class="button-group">
                <button type="submit" class="guardar-button">Guardar</button>
                <a href="{{ route('dashboard', ['section' => 'reports']) }}" class="cancelar-button">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
