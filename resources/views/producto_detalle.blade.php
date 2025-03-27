<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/destilos.css') }}">
    <title> Productos detalle</title>
</head>
<body>
<div id="encabezado">
    <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Detalle de Productos</h1>
</div>
<br>

        <div id="detalle">
            <h5>Id: {{ $data['id_producto'] }}</h5>
            <h5>Nombre: {{ $data['nombre'] }}</h5>
            <h5>Descripción: {{ $data['descripcion'] }}</h5>
            <h5>Precio: {{ $data['precio'] }}</h5>
            <h5>Stock: {{ $data['stock'] }}</h5>
            <h5><strong>Imagen:</strong></h5>
                        <img src="{{ asset('storage/' . $data['imagen']) }}" class="img-thumbnail" style="width: 150px; height: 150px;">
                        <br>
            <a href="{{ route('productos') }}">
                    <button type="button" class="btn btn-primary btn-sm">Regresar</button>
                </a>
        </div>
</body>
</html>


