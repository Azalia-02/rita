<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/mestilos.css') }}">
    <title>Lista de Medicos</title>
</head>
<body>
    <div id="encabezado">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Administrador</h1>
    </div>

    <div class="container">
        <hr><br>
        <h3>Lista de Medicos</h3>

        <!-- Barra de búsqueda -->
        <form action="{{ route('medicos') }}" method="GET" class="search-form">
            <div class="input-group">
                <input type="text" class="form-control" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar medico...">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('medicos') }}" class="btn btn-danger">Reiniciar</a>
            </div>
        </form>

        <p style="text-align: right;">
            <a href="{{ route('medico_alta') }}">
                <button type="button" class="btn btn-primary btn-sm">Nuevo Registro</button>
            </a>
        </p>

        <div class="export-import-buttons">
            <a href="{{ route('export-medicos', ['search' => request('buscar')]) }}" class="btn btn-success">
                Exportar a Excel
            </a>

            <a href="{{ route('grafica_medicos', ['search' => request('buscar')]) }}" class="btn btn-primary">
            Ver Gráfica
            </a>

            <form action="{{ route('import.medicos') }}" method="POST" enctype="multipart/form-data" class="import-form">
                @csrf
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-primary btn-sm">Importar Excel</button>
            </form>
        </div>

        <hr><br>

        <table class="table">
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>App</th>
                <th>FN</th>
                <th>Acciones</th>
            </tr>
            @foreach($medicos as $medico)
                <tr>
                    <td>{{ $medico['id_medico'] }}</td>
                    <td>{{ $medico['nombre'] }}</td>
                    <td>{{ $medico['app'] }}</td>
                    <td>{{ $medico['fn'] }}</td>
                    <td>
                        <a href="{{ route('medico_detalle', $medico['id_medico']) }}" class="btn btn-info btn-sm">Detalle</a>
                        <a href="{{ route('medico_actualizar', $medico['id_medico']) }}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{ route('medico_borrar', $medico['id_medico']) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar al medico?');">Borrar</a>
                    </td>
                </tr>
            @endforeach
        </table>

        <!-- Paginación -->
        <nav>
            <ul class="pagination">
                @for ($i = 1; $i <= ceil($total / $limit); $i++)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('medicos', ['page' => $i, 'buscar' => request('buscar')]) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>

        <a href="{{ route('panel_admin') }}" class="boton">Volver</a>
    </div>
</body>
</html>