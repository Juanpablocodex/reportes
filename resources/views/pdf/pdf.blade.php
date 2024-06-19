<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte PDF</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .reporte-detalles {
            margin-top: 20px;
        }
        .reporte-detalles table {
            width: 100%;
            border-collapse: collapse;
        }
        .reporte-detalles table, .reporte-detalles th, .reporte-detalles td {
            border: 1px solid black;
        }
        .reporte-detalles th, .reporte-detalles td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles del Reporte</h1>
        <div class="reporte-detalles">
            <table>
                <tr>
                    <th>ID</th>
                    <td>{{ $reporte->id }}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{ $reporte->nombre }}</td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td>{{ $reporte->fecha }}</td>
                </tr>
                <tr>
                    <th>Nombre de Cámara</th>
                    <td>{{ $reporte->nombre_camara }}</td>
                </tr>
                <tr>
                    <th>Incidente</th>
                    <td>{{ $reporte->incidente }}</td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td>{{ $reporte->descripcion }}</td>
                </tr>
                <tr>
                    <th>Estatus</th>
                    <td>{{ $reporte->status }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
