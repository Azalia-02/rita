<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/mestilos.css') }}">
    <title>Lista de productos</title>
</head>
<body>
    <div id="encabezado">
        <a href="{{ route('panel_admin') }}">
            <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        </a>
        <h1>Productos</h1>
    </div>
    <br>
    <div class="container">
        <br>
        <h3>Administración de registro de productos</h3>
        <hr>

        <p style="text-align: right;">
            <a href="{{ route('producto_alta') }}">
                <button type="button" class="btn btn-primary btn-sm">Nuevo Registro</button>
            </a>
        </p>

        <hr><br>
        <table class="table">
            <tr>
                <th>Foto</th>
                <th>N°</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Detalle</th>
            </tr>
            @foreach($data as $key => $producto)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $producto['imagen']) }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                    </td>
                    <td>{{ $producto['id_producto'] }}</td>
                    <td>{{ $producto['nombre'] }}</td>
                    <td>{{ $producto['descripcion'] }}</td>
                    <td>
                        <a href="{{ route('producto_actualizar', $producto['id_producto']) }}">
                            <button type="button" class="btn btn-info btn-sm">Editar</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('producto_borrar', $producto['id_producto']) }}">
                            <button type="button" class="btn btn-info btn-sm">Eliminar</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('producto_detalle', $producto['id_producto']) }}">
                            <button type="button" class="btn btn-info btn-sm">Consultar</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="{{ route('panel_admin') }}" class="boton">Volver</a>
    </div>
</body>
</html>