<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/mestilos.css') }}">
    <title>Lista de Pacientes</title>
</head>
<body>

<div id="encabezado">
        <img src="{{ 'img/dinologin.jpg' }}" alt="logo empresa" id="imgenbn">
        <h1>Administrador</h1>
    </div>

    <div class="container">
        <hr><br>
        <h3>Lista de Pacientes</h3>

        <!-- Barra de búsqueda -->
        <form action="{{ route('pacientes') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar paciente...">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('pacientes') }}" class="btn btn-danger">Reiniciar</a>
            </div>
        </form>

        <p style="text-align: right;">
            <a href="{{ route('paciente_alta') }}">
                <button type="button" class="btn btn-primary btn-sm">Nuevo Registro</button>
            </a>
        </p>

        <a href="{{ route('export-pacientes', ['search' => request('buscar')]) }}" class="btn btn-success">
        Exportar a Excel
        </a>

            <form action="{{ route('import.pacientes') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-primary btn-sm">Importar Excel</button>
            </form>
        <hr><br>

        <table class="table">
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>App</th>
                <th>FN</th>
                <th>Acciones</th>
            </tr>
            @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente['id_paciente'] }}</td>
                    <td>{{ $paciente['nombre'] }}</td>
                    <td>{{ $paciente['app'] }}</td>
                    <td>{{ $paciente['fn'] }}</td>
                    <td>
                        <a href="{{ route('paciente_detalle', $paciente['id_paciente']) }}" class="btn btn-info btn-sm">Detalle</a>
                        <a href="{{ route('paciente_actualizar', $paciente['id_paciente']) }}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{ route('paciente_borrar', $paciente['id_paciente']) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar al paciente?');">Borrar</a>
                    </td>
                </tr>
            @endforeach
        </table>

        <!-- Paginación -->
        <nav>
            <ul class="pagination">
                @for ($i = 1; $i <= ceil($total / $limit); $i++)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('pacientes', ['page' => $i, 'buscar' => request('buscar')]) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
   
    <a href="{{ route('panel_admin') }}" class="boton">Volver</a>
    </div>

</body>
</html>
